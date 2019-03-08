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
    protected $fillable=["email","name","mot_de_passe","remember_token","validation_token","avatar"];
    protected $table = 'users' ;
}
