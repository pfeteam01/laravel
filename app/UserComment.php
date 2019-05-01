<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    protected $fillable = ['id_comment','user_id'];
    protected $table = 'user_comments' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_comment' ;
}
