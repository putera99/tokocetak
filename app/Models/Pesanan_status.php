<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_status extends Model
{
    protected $table = 'pesanan_status';
    public $primaryKey = 'pesanan_status_id';
    public $timestamps = false;
    protected $casts = ['pesanan_status_id'=>'string'];
}
