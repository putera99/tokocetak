<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $primaryKey = 'pesanan_id';
    public $timestamps = false;
    protected $casts = ['pesanan_id'=>'string'];

    public function order_status()
    {
        return $this->hasOne('App\Models\Pesanan_status', 'pesanan_status_id','Status');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Pesanan_alamat','pesanan_id','pesanan_id');
    }

    public function payment_method()
    {
        return $this->hasOne('App\Models\Payments','ID','PaymentID');
    }
}
