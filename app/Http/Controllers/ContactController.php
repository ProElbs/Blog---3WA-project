<?php

namespace App\Http\Controllers;

// Use des class qui ne sont pas dans le même namespace Controllers
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Contact;
/**
 * Un controller controle les données d'une ou plusieurs pages
 */
class ContactController extends Controller
{

  /**
   * Une méthode de controller = 1 page
   * Request $request: un objet représentant ma requête
   * $request contient toutes les données en POST de manière sécurisé
   */

  /**
   * Sending a contact request
   * @param  Request $request
   */
  public function contact(Request $request)
  {
    // Récupérer mes données en POST de ma requête
    // dump($request->all());

    $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^([a-z]{2,}[\-\ ]?[a-z]{1,})$/i',
            'email' => 'required|email',
            'website' => 'active_url',
            'subject' => 'required|in:contact,article,partnership,other',
            'message' => 'required|min:5|max:400',
            'generalTerms' => 'required',
            'optionSex' => 'required'
        ]);
    // savoir si le formulaire a été envoyé (isMethod('post'))
    // et qu'il à échoué au niveau des validations (fails())
    if ($validator->fails() && $request->isMethod('post')) {
        return redirect('contact') // Nom de la route
                    ->withErrors($validator) // Avec les erreurs
                    ->withInput();  // Avec les champs remplis
    } elseif ($request->isMethod('post')) {
      // formulaire est soumis et valide
      // Création d'un nouveau contact en bdd
      $contact = new Contact();
      $contact->nom = $request->name;
      $contact->email = $request->email;
      $contact->website = $request->website;
      $contact->sujet = $request->subject;
      $contact->message = $request->message;
      $contact->sexe = $request->optionSex;
      // enregistrer en bdd le contact
      $contact->save();
      // Redirection avec message de success
      return redirect()->route('contact') // redirige vers la page contact
                       ->with('success', 'Votre formulaire de contact a bien été pris en compte');
    }

    // GET : affichage du formulaire
    return view('contact');
  }

// End of controller
}
