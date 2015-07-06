<?php
/**
* IndexController.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Cloud/app/Http/Controllers/IndexController.php
*/
namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Session;

/**
* Class Index
*
* Class permettant d'ajouter les membres
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Cloud/app/Http/Controllers/IndexController.php
*/
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showIndex()
    {
        if (Auth::check()) {
            Session::flash('messageDejaCo', 'Vous êtes déjà connecter !!!');
            return redirect()->action('UtilisateursController@panel');
        }
        return view('utilisateur.accueil');
    }
}