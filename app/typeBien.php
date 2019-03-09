<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeBien extends Model
{
    // Table Name
    protected $table = 'table_typeBien';
    // Primary Key
    //public $primaryKey = 'id';
    
    
    public function annonce(){
        return $this->belongsTo('App\annonce');
    }

    public function annonces(){
        return $this->hasMany('App\typeBien');
    }
}
