<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnonceImage extends Model
{
    protected $fillable = ['id_image','nom_image','annonce_id'];
    protected $table = 'annonce_images' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_image';
}
