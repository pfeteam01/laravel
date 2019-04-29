<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $fillable = ['id_notification','user_id'];
    protected $table = 'notification_users' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_notification' ;
}
