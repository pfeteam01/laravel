<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnonceAgence extends Model
{
    protected $fillable = ['id_annonce','agence_id'];
    protected $table = 'annonce_agences' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_annonce' ;
}
