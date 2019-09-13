<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    protected $table = 'warna';
    public $primaryKey = 'warna_id';
    public $timestamps = false;
    protected $casts = ['warna_id'=>'string'];

    // public function
}
