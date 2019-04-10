<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    protected $fillable = ['id_favoris','annonce_id','user_id'];
    protected $table = 'favoris' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_favoris';
}
