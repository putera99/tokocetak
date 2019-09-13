<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoProductFlashSell extends Model
{
    protected $table = 'InfoProductFlashSell';

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
