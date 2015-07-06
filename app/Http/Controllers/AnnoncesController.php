<?php
/**
* AnnoncesController.php
* 
* PHP Version 5.2
*
* @category Model
* @package  Model
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Could/app/AnnoncesController.php
*/

namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;

use Request;
use Auth;
use Session;
use File;
use DB;
/**
* Class Annonce
*
* Class permettant d'ajouter des fichiers
* 
* PHP Version 5.2
*
* @category Model
* @package  Model
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Could/app/AnnoncesController.php
*/ 
class AnnoncesController extends Controller
{

    /**
     * AjoutAnnonce
     *
     * Fonction qui affiche le formulaire d'ajout d'annonce
     *
     * @return redirection vers le formulaire d'ajout
     */
    public function ajoutAnnonce()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('annonce.ajoutAnnonce');
    }
    /**
     * AjouterAnnonce
     *
     * Fonction qui une annonce
     *
     * @return redirection vers le formulaire d'ajout
     */
    public function ajouterAnnonce()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        $data = Request::all();
        $fichier = $data['file'];
        if ($fichier[0] == null) {
            Session::flash('messageNoImage', 'Vous devez mettre au moins une image !!!');
            return redirect()->back();
        }
        if (count($fichier) > 4) {
            Session::flash('messageTooMuchImage', 'Vous devez mettre que 4 images !!!');
            return redirect()->back();
        }
        if (count($fichier) > 0 && count($fichier) < 5) {
            $tailleFile = array();
            $typeFile = array();
            $nameFile = array();
            foreach ($fichier as $value) {
                array_push($tailleFile, $value->getClientSize());
                array_push($typeFile, $value->getClientMimeType());
                array_push($nameFile, $value->getClientOriginalName());
                $name = implode("|", $nameFile);
            }
        }
        for ($i=0; $i < count($fichier); $i++) {
            if ($tailleFile[$i] > 0) {
                if (substr($typeFile[$i], 0, 5) == 'image') {
                    $id = Auth::user()->id;
                    $path = storage_path().'/user-'.$id;
                    if (File::exists($path) == false) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                } else {
                    Session::flash('messagePasImage', 'Vous ne pouvez mettre que des images !!!');
                    return redirect()->back();
                }
            }
        }
        $data['description'] = preg_replace('/\'/', ' ', $data['description']);
        DB::table('annonces')->insert(['titre' => $data['titre'], 'picture' => $name, 'user_id' => $id, 'prix' => $data['prix'],'monnaie' => $data['typePrix'],'description' => $data['description'], 'numero' => $data['numero'], 'email' => Auth::user()->email]);
        $last_id = DB::getPdo()->lastInsertId();
        for ($i=0; $i < count($fichier); $i++) {
            $pathAnnonce = storage_path().'/user-'.$id.'/'.$last_id;
            $fichier[$i]->move($pathAnnonce, $nameFile[$i]);
        }
        Session::flash('messageAnnonce', 'Annonce ajouter avec succès !!!');
        return redirect()->back();
    }
    /**
     * DisplayUserAnnonce
     *
     * Fonction qui affiche tous les annonces
     *
     * @return redirection vers la page d'affichages des annonces
     */
    public function displayUserAnnonce()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('annonce.displayUserAnnonce');
    }
    /**
     * DisplayAllAnnonce
     *
     * Fonction qui affiche tous les annonces
     *
     * @return redirection vers la page d'affichages des annonces
     */
    public function displayAllAnnonce()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('annonce.displayAllAnnonce');
    }
    /**
     * UpdateUserAnnonce
     *
     * Fonction qui modifie les annonces de l'user
     *
     * @return redirection vers la page de modification des annonces
     */
    public function updateUserAnnonce()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('annonce.updateUserAnnonce');
    }
    /**
     * UpdateCurrentAnnonce
     *
     * Fonction qui modifie l'annonce de l'user
     *
     * @return redirection vers la page de modification des annonces
     */
    public function updateCurrentAnnonce()
    {
        $data = Request::all();
        var_dump($data);
        $currentAnnonce = DB::table('annonces')->where('id', $data['id'])->first();
        $images = explode("|", $currentAnnonce->picture);
        $limit = 4 - count($images);
        $fichier = $data['file'];
        if ($fichier[0] == null) {
            $name = $currentAnnonce->picture;
            DB::table('annonces')->where('id', $data['id'])->update(['titre' => $data['titre'], 'picture' => $name, 'user_id' => Auth::user()->id, 'prix' => $data['prix'],'monnaie' => $data['typePrix'],'description' => $data['description'], 'numero' => $data['tel']]);
            Session::flash('messageUpdateAnnonce', 'Annonce modifier avec succès !!!');
            return redirect()->back();
        }
        if (count($fichier) >= $limit) {
            Session::flash('messageTooMuchImage', 'Vous ne pouvez ajouter que '.$limit.' images !!!');
            return redirect()->back();
        }
        if (count($fichier) > 0 && count($fichier) <= $limit) {
            $tailleFile = array();
            $typeFile = array();
            $nameFile = array();
            for ($i=0; $i < count($images); $i++) {
                array_push($nameFile, $images[$i]);
            }
            foreach ($fichier as $value) {
                array_push($tailleFile, $value->getClientSize());
                array_push($typeFile, $value->getClientMimeType());
                array_push($nameFile, $value->getClientOriginalName());
                $name = implode("|", $nameFile);
            }
        }
        for ($i=0; $i < count($fichier); $i++) {
            if ($tailleFile[$i] > 0) {
                if (substr($typeFile[$i], 0, 5) == 'image') {
                    $id = Auth::user()->id;
                    $path = storage_path().'/user-'.$id;
                    if (File::exists($path) == false) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                } else {
                    Session::flash('messagePasImage', 'Vous ne pouvez mettre que des images !!!');
                    return redirect()->back();
                }
            }
        }
        DB::table('annonces')->where('id', $data['id'])->update(['titre' => $data['titre'], 'picture' => $name, 'user_id' => Auth::user()->id, 'prix' => $data['prix'],'monnaie' => $data['typePrix'],'description' => $data['description'], 'numero' => $data['tel']]);
        for ($i=0; $i < count($fichier); $i++) {
            $pathAnnonce = storage_path().'/user-'.$id.'/'.$currentAnnonce->id;
            $fichier[$i]->move($pathAnnonce, $nameFile[$i]);
        }
        Session::flash('messageUpdateAnnonce', 'Annonce modifier avec succès !!!');
        return redirect()->back();
    }
    /**
     * DeleteCurrentAnnonce
     *
     * Fonction qui supprime l'annonce de l'user
     *
     * @return redirection vers la page de modification des annonces
     */
    public function deleteCurrentAnnonce()
    {
        $data = Request::all();
        $id = Auth::user()->id;
        $id_annonce = $data['id'];
        $value = DB::table('annonces')->where('id', '=', $id_annonce)->first();
        $images = explode("|", $value->picture);
        var_dump($images);
        for ($i=0; $i < count($images); $i++) {
            File::delete(storage_path().'/user-'.$id.'/'.$id_annonce.'/'.$images[$i]);
        }
        rmdir(storage_path().'/user-'.$id.'/'.$id_annonce);
        DB::table('annonces')->where('id', '=', $id_annonce)->delete();
        Session::flash('messageDeleteAnnonce', 'Annonce supprimer avec succès !!!');
        return redirect()->back();
    }
    /**
     * Recherche
     *
     * Fonction qui recherche des annonces
     *
     * @return redirection vers la page de recherche des annonces
     */
    public function recherche()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return redirect()->action('IndexController@showIndex');
        }
        return view('annonce.recherche');
    }
    /**
     * RechercheAnnonce
     *
     * Fonction qui recherche des annonces
     *
     * @param string; $titre   ; titre de l'annonce
     * @param string; $prixMin ; prix minimum de l'annonce rechercher
     * @param string; $prixMax ; prix maximum de l'annonce rechercher
     *
     * @return redirection vers la page de resultat des annonces
     */
    public function rechercheAnnonce($titre=null, $prixMin=null, $prixMax=null)
    {
        $data = Request::all();
        if (empty($data['titre'])) {
            Session::flash('messageRecherche', 'Vous devez au moins mettre un titre pour faire une recherche !!!');
            return redirect()->back();
        }
        $titre = $data['titre'];
        if (isset($data['prixMin']) || isset($data['prixMax'])) {
            if ($data['prixMin'] < $data['prixMax']) {
                Session::flash('prixMin-prixMax', 'prixMin-prixMax');
                return view('annonce.rechercheAnnonce', compact('titre', 'prixMin', 'prixMax'));
            }
            if ($data['prixMin'] > $data['prixMax']) {
                Session::flash('prixMax-prixMin', 'prixMax-prixMin');
                return view('annonce.rechercheAnnonce', compact('titre', 'prixMin', 'prixMax'));
            }
            if ($data['prixMin'] == $data['prixMax']) {
                Session::flash('prixMax', 'prixMax');
                return view('annonce.rechercheAnnonce', compact('titre', 'prixMax'));
            }

        } else {
            Session::flash('titre', 'titre');
            return view('annonce.rechercheAnnonce', compact('titre'));
        }
    }
}