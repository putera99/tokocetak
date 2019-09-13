<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_warna extends Model
{
    protected $table = 'product_warna';
    public $primaryKey = 'product_warna_id';
    public $timestamps = false;
    protected $casts = ['product_warna_id'=>'string'];

    public function warna(){
    	return $this->belongsTo('App\Models\Warna','warna_id','warna_id');
    }
}
