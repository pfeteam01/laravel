<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    protected $fillable = ['id_appartement','nb_pieces','nb_chambres','nb_toilettes','nb_salles_de_bain','nb_balcons','num_etage','meuble','parking','assenceur','interphone'];
    protected $table = 'appartements' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_appartement';
}
