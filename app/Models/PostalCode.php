<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $table = 'PostalCode';
    public $primaryKey = 'ID';
    public $timestamps = false;
    protected $casts = ['ID'=>'string'];

    

}
