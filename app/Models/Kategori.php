<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    public $primaryKey = 'kategori_id';
    protected $casts = ['kategori_id'=>'string'];

    
}
