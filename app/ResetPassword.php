<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class resetPassword, c'est la classe qui sert de modèle pour la table resetPassword
 * @package App
 */
class resetPassword extends Model
{
    protected $fillable = ['user_id','code'];
	protected $table = 'resetpassword' ;
}
