<?php
/**
* UtilisateursController.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Cloud/app/Http/Controllers/UtilisateursController.php
*/
namespace freeads\Http\Controllers;

use Request;
use Validator;
use Input;
use Hash;
use Redirect;
use DB;
use Session;
use Auth;

/**
* Class Utilisateur
*
* Class permettant d'ajouter les membres
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Cloud/app/Http/Controllers/UtilisateursController.php
*/

class UtilisateursController extends Controller
{
    /**
      * Inscription
      *
      * Fonction ajout membre
      *
      * @return view; redirection vers le login
      */
    public function inscription ()
    {
        if (Auth::check()) {
            Session::flash('messageDejaCo', 'Vous êtes déjà connecter !!!');
            return redirect()->action('UtilisateursController@panel');
        }
        return view('utilisateur.inscription');
    }
    /**
      * Ajout
      *
      * Fonction ajout membre
      *
      * @return view; redirection vers le login
      */
    public function ajout ()
    {
        $rules = array('name' => 'required', 'lastname' => 'required', 'name' => 'required', 'birthdate' => 'required', 'username' => array('required', 'unique:utilisateurs,username'), 'email' => array('required', 'email', 'unique:utilisateurs,email'), 'password' => array('required', 'min:5'));

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            Session::flash('messageUserCreatedFailed', 'Inscription failed !!!');
            return redirect()->back();
        } else {
            $data = Request::all();
            $password = $data['password'];
            $password = Hash::make($password);
            $users = DB::table('utilisateurs')->get();
            DB::table('utilisateurs')->insert(['lastname' => $data['lastname'], 'name' => $data['name'], 'username' => $data['username'], 'password' => $password, 'birthdate' => $data['birthdate'], 'email' => $data['email'], 'remember_token' => $data['_token'], 'bloquer' => 'non', 'valider' => 'oui']);
            $last_id = DB::getPdo()->lastInsertId();
            mail($data['email'], 'confirmation email', 'veuillez confirmer votre inscription en cliquant <a href=\'http://localhost:3000/public/index.php/valider/$last_id\' title="cliquer moi !!">Cliquer moi !!</a>');
            Session::flash('messageUserCreated', 'Inscription réussi !!!');
            return Redirect::to('inscription');
        }
    }
    /**
      * Connexion
      *
      * Fonction login
      *
      * @return view; redirection vers le panel
      */
    public function connexion ()
    {
        if (Auth::check()) {
            Session::flash('messageDejaCo', 'Vous êtes déjà connecter !!!');
            return redirect()->action('UtilisateursController@panel');
        }
        return view('utilisateur.connexion');
    }
    /**
      * Verif
      *
      * Fonction login
      *
      * @return view; redirection vers le panel
      */
    public function verif ()
    {
        $data = Request::all();
        $pseudo = $data['username'];
        $pass = $data['password'];
        if (Auth::attempt(array('username' => $pseudo, 'password' => $pass, 'bloquer' => 'non', 'valider' => 'oui'))) {
            return redirect()->action('UtilisateursController@panel');
        } else {
            Session::flash('messageVerif', 'Mauvais pseudo et/ou mot de passe et/ou user bloquer et/ou user pas valider email');
            return redirect()->back();
        }
    }
    /**
      * Panel
      *
      * Fonction afficher le panel user
      *
      * @return view; redirection vers le panel
      */
    public function panel ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('utilisateur.panel');
    }
    /**
      * Profil
      *
      * Fonction afficher les detail de l'user
      *
      * @return view; redirection vers l'affichage du profil user
      */
    public function profil ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('utilisateur.profil');
    }
    /**
      * Deco
      *
      * Fonction deconnexion
      *
      * @return view; redirection vers le login
      */
    public function deco ()
    {
        Auth::logout();
        return redirect()->action('IndexController@showIndex');
    }
    /**
      * UpdateUser
      *
      * Fonction modifier porifl
      *
      * @return view; redirection vers le profil
      */
    public function updateUser ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        $data = Request::all();
        $users = DB::table('utilisateurs')->get();
        foreach ($users as $value) {
            if ($data['username'] == $value->username && $data['username'] != Auth::user()->username) {
                Session::flash('messageUpdateUserUsername', 'Pseudo déjà pris !!');
                return redirect()->back();
            }
        }
        $id = Auth::user()->id;
        DB::table('utilisateurs')->where('id', $id)->update(['name' => $data['name'], 'lastname' => $data['lastname'], 'username' => $data['username'], 'birthdate' => $data['birthdate'], 'email' => $data['email'], 'updated_at' => DB::raw('now()')]);
        $userAnnonce = DB::table('annonces')->where('user_id', $id)->get();
        foreach ($userAnnonce as $value) {
            DB::table('annonces')->update(['email' => $data['email']]);
        }
        Session::flash('messageUpdateUser', 'Changement effectuer avec succes !!');
        return redirect()->back();
    }
    /**
      * UpdateUserPass
      *
      * Fonction modifier pass de l'user
      *
      * @return view; redirection vers le profil
      */
    public function updateUserPass ()
    {
        $data = Request::all();
        $currentPass = Auth::user()->password;
        $data['oldPassword'];
        if (Hash::check($data['oldPassword'], $currentPass) && Hash::check($data['newPassword'], $currentPass) == false) {
            $id = Auth::user()->id;
            $newPassword = Hash::make($data['newPassword']);
            DB::table('utilisateurs')->where('id', $id)->update(['password' => $newPassword]);
            Session::flash('messagePass', 'Pass changer avec succès !!!');
            return redirect()->back();
        }
        if (Hash::check($data['oldPassword'], $currentPass) == false) {
            Session::flash('messageOldPass', 'Vous n\'avez pas bien ecrit votre pass actuel');
            return redirect()->back();
        }
        if (Hash::check($data['newPassword'], $currentPass)) {
            Session::flash('messageNewPass', 'Votre nouveau pass ne peut etre votre pass actuel');
            return redirect()->back();
        }
    }
    /**
      * Message
      *
      * Fonction afficher les messages de l'user
      *
      * @return view; redirection vers l'affichage des messages de l'user
      */
    public function message ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('utilisateur.message');
    }
    /**
      * AjouterMessage
      *
      * Fonction envoie message de l'user
      *
      * @return view; redirection vers l'affichage des messages de l'user
      */
    public function ajouterMessage ()
    {
        $data = Request::all();
        var_dump($data);
        if (empty($data['titre'])) {
            Session::flash('messagePasTitre', 'Vous devez ecrire un titre !!!');
            return redirect()->back();
        }
        if (empty($data['content'])) {
            Session::flash('messagePasContent', 'Vous devez ecrire un contenu !!!');
            return redirect()->back();
        }
        DB::table('messages')->insert(['sender_id' => Auth::user()->id, 'recever_id' => $data['send_to'], 'titre' => $data['titre'], 'content' => $data['content'], 'created_at' => DB::raw('now()')]);
        Session::flash('messageSend', 'Message envoyer avec succès !!');
        return redirect()->back();
    }
    /**
      * VoirMessage
      *
      * Fonction voir message de l'user
      *
      * @return view; redirection vers l'affichage des messages de l'user
      */
    public function voirMessage ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('utilisateur.voirMessage');
    }
    /**
      * RepondreMessage
      *
      * Fonction repondre au message selectionner
      *
      * @return view; redirection vers l'affichage des messages de l'user
      */
    public function repondreMessage ()
    {
        $data = Request::all();
        if (empty($data['content'])) {
            Session::flash('messagePasContent', 'Vous devez ecrire un contenu !!!');
            return redirect()->back();
        }
        var_dump($data);
        $titre = '(RE:)'.$data['title'];
        DB::table('messages')->insert(['sender_id' => Auth::user()->id, 'recever_id' => $data['id'], 'titre' => $titre, 'content' => $data['content'], 'created_at' => DB::raw('now()')]);
        Session::flash('messageSend', 'Message envoyer avec succès !!');
        return redirect()->back();
    }
}
    ?>
