<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $table = 'ukuran';
    public $primaryKey = 'ukuran_id';
    public $timestamps = false;
    protected $casts = ['ukuran_id'=>'string'];
}
