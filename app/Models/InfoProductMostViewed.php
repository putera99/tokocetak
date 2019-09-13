<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoProductMostViewed extends Model
{
    protected $table = 'InfoProductMostViewed';

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
