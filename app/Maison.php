<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    protected $fillable = ['id_maison','nb_pieces','nb_chambres','nb_toilettes','nb_salles_de_bain','nb_balcons','nb_etage','meuble','garage','jardin'];
    protected $table = 'maisons' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_maison';
}
