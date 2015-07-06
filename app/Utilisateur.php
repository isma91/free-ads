<?php
/**
* Utilisateur.php
* 
* PHP Version 5.2
*
* @category Model
* @package  Model
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Could/app/Utilisateur.php
*/

namespace freeads;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
* Class Utilisateur
*
* Class permettant d'ajouter des fichiers
* 
* PHP Version 5.2
*
* @category Model
* @package  Model
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/Projets_MVC_Could/app/Utilisateur.php
*/ 

class Utilisateur extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'utilisateurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'Utilisateurname', 'password', 'email', 'birthdate', 'created_at', 'update_at', 'bloquer', 'remember_token', 'valider'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

}