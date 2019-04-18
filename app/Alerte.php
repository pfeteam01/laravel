<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $fillable = ['id_alerte','wilaya','mail','surface_min','surface_max','etat_alerte','lp_min','lp_max','user_id'];
    protected $table = 'alertes' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_alerte';
}
