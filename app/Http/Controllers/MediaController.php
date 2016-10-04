<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Media;
use Carbon\Carbon;

class MediaController extends Controller
{
  /**
   * Add a media in database
   * @param  Request $request
   */
  public function media(Request $request)
  {
    // Récupérer mes données en POST de ma requête
    // dump($request->all());
    $validator = Validator::make($request->all(), [
        'title' => 'required|regex:/^([0-9a-z\-\.\?\!\'\(\)\ ]{3,100})$/i',
        'page' => 'required|exists:page,id',
        // regex complexe, laravel n'accepte pas et donc il faut mettre sous forme tableau
        'url' => ['required', 'active_url', 'regex:/^http(s)?\:\/\/(www.)?(youtube.com\/watch\?|vimeo.com|dailymotion.com\/video\/)[a-zA-Z0-9\/\?\-\_\=\+\(\)\&\$\€\^]{1,}$/'],
        'visibility' => 'required|in:0,1',
        'activatedAt' => 'required|date_format:d/m/Y|after:today'
      ],[
        'required' => 'Le champ :attribute doit être rempli',
        'regex' => ':attribute invalide',
        'date_format' => 'Le format de la date doit être dd/mm/yyyy',
        'regex.url' => 'Video uniquement depuis Youtube, Dailymotion ou Vimeo'
    ]);

    if ($validator->fails() && $request->isMethod('post')) {
      return redirect('media') // Nom de la route
                  ->withErrors($validator) // Avec les erreurs
                  ->withInput();  // Avec les champs remplis
    } elseif ($request->isMethod('post')) {
      // formulaire est soumis et valide
      // Création d'un nouveau media en bdd
      $dateActivation = Carbon::createFromFormat('d/m/Y', $request->activatedAt);
      $media = new Media();
      $media->titre = $request->title;
      $media->page_id = $request->page;
      $media->url = $request->url;
      $media->visibilite = $request->visibility;
      $media->activated_at = Carbon::parse($dateActivation); // parse en y/m/d
      // enregistrer en bdd le media
      $media->save();
      // Redirection avec message de success
      return redirect()->route('media') // redirige vers la page media
                       ->with('success', '"'.$media->titre.'" a bien été ajouté en tant que média.');
    }
    
    // c'est la response au format HTML (voir schéma)
    return view('media');
  }


// End of controller
}
