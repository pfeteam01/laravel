<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['id_location','loyer','charge','depot_de_garantie','date_de_disponibilite','duree_min'];
    protected $table = 'locations' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_location';
}
