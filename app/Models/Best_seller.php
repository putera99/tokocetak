<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Best_seller extends Model
{
    protected $table = 'best_seller';
    public $primaryKey = 'best_seller_id';
    public $timestamps = false;
    protected $casts = ['best_seller_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
