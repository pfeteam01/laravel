<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable ;

    protected $fillable = ['id_agence','name','email','avatar','background_img','description','wilaya','adresse','web_site','password','is_activated'] ;
    protected $table = 'agences' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_agence' ;
    protected $guard = 'agence' ;
}
