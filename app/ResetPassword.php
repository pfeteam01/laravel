<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $fillable = ['id','user_id','code'];
    protected $table = 'resetpassword' ;
    public $timestamps = true ;
    protected $primaryKey = 'id' ;
}
