<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User : c'est la classe de modèle de l'utilisateur
 * @package App
 */
class User extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable ;
    protected $fillable = ['id_user','username','mail','password','remember_token','validation_token','photo_de_profil'];
    protected $table = 'users' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_user';

}
