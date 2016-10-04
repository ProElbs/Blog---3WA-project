<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model
{
    protected $table = "article";

    /**
     * Select all article and get $table info
     * @param  array  $table columns required
     * @return Pagination by 5
     */
    public static function selectArticle(array $table) {
      return DB::table('article')->select($table)
                                 ->Paginate(5);
    }

    /**
     * Number of article
     */
    public static function countArticle() {
      return DB::table('article')->select(DB::raw('count(*) as numberArticle'))
                                 ->first();
    }

    /**
     * Chnage the visibility of an article
     * @param  int    $id         id of the article
     * @param  bool   $visibilite visibility of the article
     */
    public static function changeVisibilite($id, $visibilite) {
      return DB::table('article')->where('id', $id)
                                 ->update(['visibilite' => $visibilite]);
    }

    /**
     * Delete an article from database
     * @param  int $id id of the article to delete
     */
    public static function deleteArticle($id) {
      return DB::table('article')->where('id', $id)
                                 ->delete();
    }

    /**
     * Get information about one article
     * @param  array  $table column of the table required
     * @param  int    $id    id of the article required
     */
    public static function detailArticle($request, $id) {
      return DB::table('article')->select($request)
                                 ->where('id', $id)
                                 ->first();
    }

    /**
     * Check if the article is in favoriteArticle Session or not
     * @param  int $id id of the article
     */
    public static function favoriteOrNot($id) {
      if(session()->has('favoriteArticle')) {
        $tableau = session('favoriteArticle');
        foreach ($tableau as $key => $value) {
          if ($key == $id) {
            return true;
          }
        }
      }
      return false;
    }

    /**
     * get all favorite article in favoriteArticle Session
     * @return array $data array of article in favoriteArticle Session
     */
    public static function allFavorite() {
      $data = session('favoriteArticle');
      return $data;
    }

    /**
     * Get the number of article with $visibilite setting
     * @param  bool $visibilite visibility of an article
     */
    public static function getNbArticlesVisibles($visibilite) {
      // DB = query builder
      return DB::table('article')->select(DB::raw('count(*) as nb'))
                                 ->where('visibilite', '=', $visibilite) // on peut enlever le égal c'est égal par défaut, cependant prendre cette syntaxe si on veut mettre supp ou inf
                                 ->first();
      // Autre solution en utilisant eloquent
      // return Article::where('visibilite', $visibilite)
      //                ->count();
    }

    /**
     * get the number of category having articles
     */
    public static function categoryFilled() {
      return Article::groupBy('categorie_id')->get()->count();
    }

    /**
     * Number of Articles by Category
     * SELECT COUNT(article.id) AS nbArticle, categorie.titre
     * FROM article
     * INNER JOIN categorie ON categorie.id = article.categorie_id
     * GROUP BY categorie_id
     */
    /**
     * get the number of article per category
     */
    public static function getNbArticlesByCategories() {
      return Article::select(DB::raw('COUNT(article.id) as value'), 'categorie.titre as label')
                    ->join('categorie', 'categorie.id', '=', 'article.categorie_id')
                    ->groupBy('categorie_id')
                    ->get();
    }

    /**
     * Get the number of comments per article
     */
    public static function getNbCommentsByArticles() {
      return Article::select('article.titre as label', DB::raw('COUNT(comment.id) as value'))
                    ->join('comment', 'article.id', '=', 'comment.article_id')
                    ->groupBy('comment.article_id')
                    ->get();
    }

    /**
     * Get the category of an article
     * @param  int $id id of the article
     */
    public static function getCategorieOfArticle($id) {
      return Article::select('categorie.titre as categorieTitre')
                    ->join('categorie', 'categorie.id', '=', 'article.categorie_id')
                    ->where('article.id', $id)
                    ->first();
    }

// End of class
}
