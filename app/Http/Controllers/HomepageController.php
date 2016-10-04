<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Categorie;
use App\Media;
use App\Comment;
use App\Http\Requests;
use App;
use Twitter;


class HomepageController extends Controller
{
    /**
     * Homepage when logged in
     * gives number of article, categories having 1 or + articles
     * number of media used in article, number of comment activated
     * genereate 1 random article with his comments
     * get last 5 tweets of DamienElbs
     */
    public function homepage() {
      $nbArticle = Article::getNbArticlesVisibles(1);
      $nbCategorie = Article::categoryFilled();
      $nbMedia = Media::getMediaInArticle();
      $nbComment = Comment::getNbCommentActif(2);

      // Utilisation Eloquent
      // $nbCat = Categorie::has('articles')->count();
      // dump($nbcat);
      // exit;
      //
      // $nbMedias = Media::has('articles')->count();
      // dump($nbMedias)
      // exit;

      // Génération d'un article aléatoire
      $randomArticle = Article::all()->random();
      // La catégorie d'un article
      $categorie = Article::getCategorieOfArticle($randomArticle->id);

      $nbCommentByArticle = Comment::getNbCommentOfArticle ($randomArticle->id);

      // Twitter
      $tweets = Twitter::getUserTimeline([
        'screen_name' => 'DamienElbs',
        'count' => 5,
        'format' => 'object',
      ]);

      return view('homepage', [
        'nbArticle' => $nbArticle->nb,
        'nbMedia' => count($nbMedia),
        'nbComment' => $nbComment->nb,
        'nbCategorie' => $nbCategorie,
        'oneRandomArticle' => $randomArticle,
        'categorieRandomArticle' => $categorie->categorieTitre,
        'nbCommentOfArticle' => $nbCommentByArticle,
        'tweets' => $tweets,
      ]);
    }

    /**
     * Number of article per categorie
     * @return JSON
     */
    public function statsCategories() {

      $nbCat = Article::getNbArticlesByCategories();

      // parser les values
      foreach ($nbCat as $key => $categorie) {
        // caster une chaine en nombre
        $nbCat[$key]['value'] = (int) $nbCat[$key]['value'];
      }
      // dump($nbCat); exit;

      return $nbCat->toJson();
    }

    /**
     * Number of comments per article
     * @return JSON
     */
    public function statsArticles() {
      $nbArticle = Article::getNbCommentsByArticles();
      // parse values
      foreach ($nbArticle as $key => $article) {
        $nbArticle[$key]['label'] = mb_strimwidth($nbArticle[$key]['label'], 0, 30, "...");
        $nbArticle[$key]['value'] = (int) $nbArticle[$key]['value'];
      }
      return $nbArticle->toJson();
    }

    /**
     * Get number of comments per year this last 5 years
     * @return array $datas array of year and number of comment during the year
     */
    public function statsComments() {
      $datas = [];
      for ($i=date('Y')-5; $i < date('Y'); $i++) {
        $datas[]= [
                    'year' => (string) $i,
                    'value' => Comment::getCommentByYear($i)
                  ];
      }
      return $datas;
    }

    /**
     * Chnage language of the website
     * @param  string $locale language choosen (fr, en, es...)
     */
    public function langue($locale) {
      // App est toute la configuration de l'app
      App::setLocale($locale);

      return redirect()->back()
                       ->with('success',
                       trans('messages.successLangue')
                     );
    }

    /**
     * Post a tweet with account set
     * @param Request $request
     */
    public function addTweet(Request $request) {
      Twitter::postTweet(['status' => $request->tweet]);

      return redirect()->back()
                       ->with('success', 'Tweet envoyé');
    }


// End of controller
}
