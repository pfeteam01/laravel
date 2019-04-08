<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['id_notification','annonce_id','user_id','etat'];
    protected $table = 'notifications';
    protected $primaryKey = 'id_notification';
    public $timestamps = true ;
}
