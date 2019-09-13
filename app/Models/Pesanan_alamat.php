<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_alamat extends Model
{
    protected $table = 'pesanan_alamat';
    public $primaryKey = 'pesanan_alamat_id';
    public $timestamps = false;
    protected $casts = ['pesanan_alamat_id'=>'string'];
}
