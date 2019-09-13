<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'Provinsi';
    public $primaryKey = 'ID';
    public $timestamps = false;
    protected $casts = ['ID'=>'string'];

    
}
