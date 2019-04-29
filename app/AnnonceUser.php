<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnonceUser extends Model
{
    protected $fillable = ['id_annonce','user_id'];
    protected $table = 'annonce_users' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_annonce' ;
}
