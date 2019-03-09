<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maison extends domcile 
{
     // Table Name
    protected $table = 'table_maison';
    // Primary Key
    //public $primaryKey = 'id';
    
    use HasParentModel;
    
}
