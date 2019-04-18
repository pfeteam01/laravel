<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BienAlerte extends Model
{
    protected $fillable = ['id_bien','alerte_id','nom_type_bien'];
    protected $table = 'bien_alertes' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_bien' ;
}
