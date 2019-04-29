<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationAgence extends Model
{
    protected $fillable = ['id_notification','agence_id'];
    protected $table = 'notification_agences' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_notification' ;
}
