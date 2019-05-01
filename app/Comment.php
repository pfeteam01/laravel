<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id_comment','body_comment','annonce_id'];
    protected $table = 'comments' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_comment' ;

    public function Annonce(){
        return $this->belongsTo('App\Annonce');
    }
}
