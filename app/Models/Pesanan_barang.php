<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_barang extends Model
{
    protected $table = 'pesanan_barang';
    public $primaryKey = 'pesanan_barang_id';
    public $timestamps = false;
    protected $casts = ['pesanan_barang_id'=>'string'];

    public function produk(){
    	return $this->hasOne('App\Models\viewStoreProducts','StoreProductID','product_id');
    }
    
    // public function warna(){
    // 	return $this->belongsTo('App\Models\Warna','warna_id','warna_id');
    // }

    // public function ukuran(){
    // 	return $this->belongsTo('App\Models\Ukuran','ukuran_id','ukuran_id');
    // }
}
