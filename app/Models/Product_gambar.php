<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_gambar extends Model
{
    protected $table = 'product_gambar';
    public $primaryKey = 'product_gambar_id';
    protected $casts = ['product_gambar_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
