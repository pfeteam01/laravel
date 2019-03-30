<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    protected $fillable = ['id_terrain','acte_prop','permis_de_construction'];
    protected $table = 'terrains' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_terrain';
}
