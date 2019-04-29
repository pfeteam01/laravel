<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChambreAlerte extends Model
{
    protected $fillable = ['id_chambre','alerte_id','nb_chambres'];
    protected $table = 'chambre_alertes' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_chambre';
}
