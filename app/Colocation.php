<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['id_colocation','loyer','charge','depot_de_garantie','date_de_disponibilite','duree_min','superficie_de_la_chambre','nombre_de_colocataires'];
    protected $table = 'colocations' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_colocation';
}
