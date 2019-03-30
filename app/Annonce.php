<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = ['id_annonce','titre','wilaya','adresse','mail','tel','description','lat','lng','superficie','etat','user_id'];
    protected $table = 'annonces' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_annonce';
}
