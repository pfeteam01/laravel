<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class terrain extends typeBien 
{
     // Table Name
    protected $table = 'table_terrain';
    // Primary Key
   // public $primaryKey = 'id';
    
       use HasParentModel;
    

    
}
