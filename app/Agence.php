<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable ;
    protected $fillable = ["id_agence","nom",'wilaya','adresse','photo_de_couverture','description','site_web'];
    protected $table = 'agences';
    public $timestamps = false ;
    protected $primaryKey = 'id_agence';
}
