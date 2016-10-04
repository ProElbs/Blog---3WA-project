<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\User;
use Mail;
use Auth;

class ArticleController extends Controller
{
  /**
   * List all articles
   * return id, titre, resume ... and count the number of articles in Database
   */
  public function lister() {
    return view('article/list', [
      // Dans la vue is suffira d'appeler $users ou $count
      'articles'=> Article::selectArticle(['id','titre','resume','image','note','annee_publication','visibilite','date_creation']),
      'count'=> Article::countArticle()->numberArticle
    ]);
  }

  /**
   *  Change the visibility of an article
   *  @param int  $id         id of article
   *  @param bool $visibilite visibility of the article
   */
  // Paramètre de l'URL sont égaux aux paramètres de l'action du controleur
  public function visibilite($id, $visibilite) {
    if ($visibilite) {
      Article::changeVisibilite($id, 0);
    } else {
      Article::changeVisibilite($id, 1);
    }
    return redirect()->route('articlelist') // redirige vers la page media
                     ->with('success', 'La visibilité a bien été changé.');
  }

  /**
   * Delete one article
   * @param  int $id id of article to delete
   */
  public function delete($id) {
    Article::deleteArticle($id);
    $likes = session('favoriteArticle', []);
    unset($likes[$id]);
    session()->put('favoriteArticle', $likes);
    return redirect()->route('articlelist') // redirige vers la page media
                     ->with('success', trans('messages.deleteArticle'));
  }

  // Autre méthode:
  // public function delete($id) {
  //  Article::find($id)->delete(); // Utilise les fonctions d'éloquent
  //  return...
  // }
  //
  // // Autre méthode:
  // public function delete(Article $id) { // Utilisation d'un param converter (Cherche un objet article ayant l'id = $id / Utilise le find() directement)
  //  $id->delete(); // Utilise les fonctions d'éloquent en plus du param converter
  //  return...
  // }

  /**
   * Give the detail on an article
   * @param  int $id id of the article
   */
  public function detail($id) {
    return view('article/detail', [
      'article' => Article::detailArticle("*", $id)
    ]);
  }

  /**
   * Export an article in PDF
   * @param  int $id id of the article
   */
  public function exportPdf($id) {
    $article = Article::detailArticle("*", $id);
    // instantiate and use the dompdf class
    $dompdf = new Dompdf(); // plutot que de faire new Dompdf, on peut rajouter Dompdf $dompdf en parametre de la méthode (usage de l'IoC)
    $dompdf->loadHtml(
      "<h1>".$article->titre."</h1>".
      "<p>".$article->resume."</p>".
      "<img src='".$article->image."' width='500'/>".
      "<p>".$article->description."</p>".
      "<h3>Informations complémentaires</h3>".
      "<p>Auteur : ".User::infoUser(['prenom'], $article->user_id)->prenom." ".User::infoUser(['nom'], $article->user_id)->nom."</p>".
      "<p>Visibilité : ".$article->visibilite."</p>".
      "<p>Note : ".$article->note."</p>".
      "<p>Date de création : ".$article->date_creation."</p>".
      "<p>Date de modification : ".$article->date_modification."</p>".
      "<p>Année de publication : ".$article->annee_publication."</p>"
     );
    // Autorise les images externes type http://...
    $options = new Options();
    $options->setIsRemoteEnabled(true);
    $dompdf->setOptions($options);
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream("Article ".$article->id,['Attachment'=>0]);
  }

  /**
   * Put or pull an article in favorite session list
   * @param  Request $request
   * @param  int    $id     id of the article
   * @param  string $titre  title of the article
   */
  public function favorite(Request $request, $id, $titre) {
    if ($request->session()->has('favoriteArticle')) {
      $tab = session('favoriteArticle');
      foreach ($tab as $key => $value) {
        if ($key == $id) {
          unset($tab[$id]);
          $request->session()->pull('favoriteArticle', 'default');
          $request->session()->put('favoriteArticle', $tab);
          return redirect()->route('articlelist')
                           ->with('danger', "Article enlevé des favoris");
        }
      }
    }
    $tab[$id] = $titre;
    $request->session()->put('favoriteArticle', $tab);
    return redirect()->route('articlelist')
                     ->with('success', "Article ajouté aux favoris");
  }

  /**
   * Clear favorite Session list of articles one by one or all at once
   * @param  int $id id of the article
   */
  public function clearFavorite($id = null) {
    if(!$id) {
      session()->pull('favoriteArticle'); // nettoyage du panier
    } else {
      $likes = session('favoriteArticle', []);
      unset($likes[$id]);
      session()->put('favoriteArticle', $likes);
    }
    return redirect()->back()
                     ->with('danger', "La liste des articles favoris a bien été supprimé");
  }

  /**
   * summaryPayment create a new customer and charge him]
   * @param  Request $request
   */
  public function summaryPayment(Request $request) {
    $somme = 0;
    foreach(\App\Article::allFavorite() as $key => $favorite) {
      $somme += Article::find($key)->price;
    }
    // Si on a soumit le formulaire
    if($request->isMethod('post')){
        // Clef privée pour que mon serveur se connecte à mon compte stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //create a customer for Stripe
        $customer = \Stripe\Customer::create(array(
          "description" => Auth::user()->prenom." ".Auth::user()->nom,
          "email" => Auth::user()->email,
          "source" => $request->stripeToken // champ caché obtenu via le formulaire rajouté en hidden dans le JS
        ));
        \Stripe\Charge::create([
          "amount" => round(($somme + $somme * 0.2)*100), // Prix en centimes
          "currency" => "eur",
          "customer" => $customer->id,
        ]);
        return redirect()->route('articlesummaryPayment') // Redirige vers la page summaryPayment
                         ->with('success', "Le payement de ".round(($somme + $somme * 0.2),2)."€ a bien été effectué");
      }
    return view('article/summaryPayment', [
      'somme' => $somme,
    ]);
  }


// End of controller
}
