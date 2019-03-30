<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgenceMembre extends Model
{
    protected $fillable = ["id_membre",'nom_membre','avatar_membre','grade_membre','agence_id'];
    protected $table = 'agence_membresagence_membres' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_membre';
}
