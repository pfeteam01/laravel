<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appartement extends domcile 
{
     // Table Name
    protected $table = 'table_appartement';
    // Primary Key
    //public $primaryKey = 'id';
         use HasParentModel;
}
