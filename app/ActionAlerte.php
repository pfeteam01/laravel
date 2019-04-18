<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionAlerte extends Model
{
    protected $fillable = ['id_action','alerte_id','nom_type_action'];
    protected $table = 'action_alertes' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_action';
}
