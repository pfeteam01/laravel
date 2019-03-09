<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    // Table Name
    protected $table = 'table_annonce';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\user');
    }
    public function typeBiens(){
        return $this->hasOne('App\typeBien');
    }
}
