<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $primaryKey = 'product_id';
    protected $casts = ['product_id'=>'string'];

    public function gambars(){
    	return $this->hasMany('\App\Models\Product_gambar','product_id','product_id');
    }

    public function gambar(){
    	return $this->hasOne('\App\Models\Product_gambar','product_id','product_id');
    }

    public function kategori(){
    	return $this->belongsTo('App\Models\Kategori','kategori_id','kategori_id');
    }

    public function warnas(){
        return $this->hasMany('App\Models\Product_warna','product_id','product_id');
    }

    public function ukurans(){
        return $this->hasMany('App\Models\Product_ukuran','product_id','product_id');
    }
}
