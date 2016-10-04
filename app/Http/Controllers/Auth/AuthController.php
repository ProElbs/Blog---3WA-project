<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon\Carbon;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $fileName = "";

        if (!empty($data['image']) && isset($data['image'])) { // si pas vide et si existe
          $destinationPath = public_path("/uploads/");
          $file = $data['image'];
          $fileName = $file->getClientOriginalName(); // nom du fichier
          $file->move($destinationPath, $fileName);
        }

        $dob = Carbon::createFromFormat('d/m/Y', $data['birthDate']);

        return User::create([
          'nom' => $data['lastName'],
          'prenom' => $data['firstName'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'telephone' => $data['phone'],
          'code_postal' => $data['postalCode'],
          'biographie' => $data['biography'],
          'ville' => $data['city'],
          'date_naissance' => Carbon::parse($dob),
          'image' => $fileName,
        ]);
    }
}
