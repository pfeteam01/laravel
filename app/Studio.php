<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['id_studio','num_etage','meuble'];
    protected $table = 'studios' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_studio';
}
