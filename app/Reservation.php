<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['id_reservation','annonce_id','mail','tel','message'];
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';
    public $timestamps = true ;
}
