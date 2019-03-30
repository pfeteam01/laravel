<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $fillable = ['id_garage'];
    protected $table = 'garages' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_garage';
}
