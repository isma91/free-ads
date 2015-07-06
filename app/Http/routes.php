<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/accueil', 'IndexController@showIndex');

Route::get('connexion', 'UtilisateursController@connexion');

Route::get('inscription', 'UtilisateursController@inscription');

Route::post('inscription', 'UtilisateursController@ajout');

Route::post('connexion', 'UtilisateursController@verif');

Route::post('deco', 'UtilisateursController@deco');

Route::get('panel', 'UtilisateursController@panel');

Route::post('panel', 'UtilisateursController@panel');

Route::get('profil', 'UtilisateursController@profil');

Route::post('profil', 'UtilisateursController@profil');

Route::get('ajoutAnnonce', 'AnnoncesController@ajoutAnnonce');

Route::post('ajoutAnnonce', 'AnnoncesController@ajoutAnnonce');

Route::post('updateUser', 'UtilisateursController@updateUser');

Route::post('updateUserPass', 'UtilisateursController@updateUserPass');

Route::post('ajouterAnnonce', 'AnnoncesController@ajouterAnnonce');

Route::get('displayUserAnnonce/', 'AnnoncesController@displayUserAnnonce');

Route::post('displayUserAnnonce/', 'AnnoncesController@displayUserAnnonce');

Route::get('displayAllAnnonce/', 'AnnoncesController@displayAllAnnonce');

Route::post('displayAllAnnonce/', 'AnnoncesController@displayAllAnnonce');

Route::get('updateUserAnnonce/', 'AnnoncesController@updateUserAnnonce');

Route::post('updateUserAnnonce/', 'AnnoncesController@updateUserAnnonce');

Route::post('updateCurrentAnnonce', 'AnnoncesController@updateCurrentAnnonce');

Route::post('deleteCurrentAnnonce', 'AnnoncesController@deleteCurrentAnnonce');

Route::get('recherche', 'AnnoncesController@recherche');

Route::post('recherche', 'AnnoncesController@recherche');

Route::post('rechercheAnnonce/', 'AnnoncesController@rechercheAnnonce');

Route::get('message/', 'UtilisateursController@message');

Route::post('message/', 'UtilisateursController@message');

Route::post('ajouterMessage', 'UtilisateursController@ajouterMessage');

Route::get('voirMessage/', 'UtilisateursController@voirMessage');

Route::post('voirMessage/', 'UtilisateursController@voirMessage');

Route::post('repondreMessage', 'UtilisateursController@repondreMessage');