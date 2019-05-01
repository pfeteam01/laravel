<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgenceComment extends Model
{
    protected $fillable = ['id_comment','agence_id'];
    protected $table = 'agence_comments' ;
    public $timestamps = false ;
    protected $primaryKey = 'id_comment' ;
}
