<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['id_vente','prix'];
    protected $table = 'ventes' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_vente';
}
