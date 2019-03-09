<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domicile extends typeBien 
{
      // Table Name
    protected $table = 'table_domicile';
    // Primary Key
    //public $primaryKey = 'id';
    
     use HasParentModel;
    
}
