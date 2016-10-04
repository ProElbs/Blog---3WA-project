<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use Carbon\Carbon;
use Image;

class UserController extends Controller
{
  /**
   * List user and count them
   * @return [type] [description]
   */
  public function lister() {
    return view('user/list', [
      // Dans la vue is suffira d'appeler $users ou $count
      'users'=> User::selectUser(['nom','prenom','email']),
      'count'=> User::countUser()->numberUser,
    ]);
  }

  /**
   * Add a user in database
   * @param Request $request
   */
  public function add(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'lastName' => 'required|regex:/^([a-z]{2,}[\-\ ]?[a-z]{1,})$/i',
      'firstName' => 'required|regex:/^([a-z]{2,}[\-\ ]?[a-z]{1,})$/i',
      'email' => 'required|email|unique:user', // unique dans la table user
      'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])([A-Za-z0-9]{6,})$/', // voir bcrypt
      'passwordConfirm' => 'required|min:6|same:password', // same:password doit être le même que la zone de saisi password
      'phone' => 'required|regex:/^([0-9]{2}[\.\-\ ]?){4}[0-9]{2}$/',
      'postalCode' => 'required|regex:/^[0-9]{5}$/',
      'biography' => 'required|min:15|max:1000',
      'city' => 'required|regex:/^[a-z\-\'\ ]{2,}$/i',
      'birthDate' => 'required|date_format:d/m/Y|before:today',
      'image' => 'image|dimensions:min_width=100,min_height=200'
      ],[
        'required' => 'Champ à compléter',
        'regex' => 'Champ invalide',
        'date_format' => 'Le format de la date doit être dd/mm/yyyy',
        'unique.email' => 'L\'adresse mail existe déjà',
        'regex.password' => 'Le mot de passe doit être composé de 6 caractères minimum avec au moins 1 majusucule, 1 minuscule et 1 chiffre',
        'same' => 'Les mots de passe doivent être identiques',
        'before' => 'La date doit être antérieur à la date du jour'
    ]);

    if ($validator->fails() && $request->isMethod('post')) {
      // Demander à Julien pk redirect utilise ajouterUtilisateur et non le nom: addUser (nom de la route)
      return redirect()->route('add') // Nom de la route
                  ->withErrors($validator) // Avec les erreurs
                  ->withInput();  // Avec les champs remplis
    } elseif ($request->isMethod('post')) {

      $dob = Carbon::createFromFormat('d/m/Y', $request->birthDate);
      // BCRYPT LARAVEL: 'password' => Hash::make($request->newPassword)

      $user = new User();
      $user->nom = $request->lastName;
      $user->prenom = $request->firstName;
      $user->email = $request->email;
      $user->password = Hash::make($request->password); // BCRYPT LARAVEL: 'password' => Hash::make($request->newPassword)
      $user->telephone = $request->phone;
      $user->code_postal = $request->postalCode;
      $user->biographie = $request->biography;
      $user->ville = $request->city;
      $user->date_naissance = Carbon::parse($dob); // parse en y/m/d

      if ($request->hasFile('image')) { // 'image' est le nom du champ de l'input
        $destinationPath = public_path("/uploads/"); // destinationPath
        $file = $request->file('image'); // je récupère le fichier

        $fileName = $file->getClientOriginalName(); // je récupère le nom du fichier

        $file->move($destinationPath, $fileName); // je bouge le fichier dans la destination
        Image::make($destinationPath.$fileName)->resize(100, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save('uploads/thumbnail_'.$fileName);
        $user->image = $fileName; // enregistrement bdd nom du fichier
      }
      // enregistrer en bdd le media
      $user->save();
      // Redirection avec message de success
      return redirect()->route('useradd') // redirige vers la page media
                       ->with('success', $user->prenom.' '. $user->nom.' a bien été créé.');
    }

    // GET : affichage du formulaire
    return view('user/add');
  }


// End of controller
}
