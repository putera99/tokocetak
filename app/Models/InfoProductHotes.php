<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoProductHotes extends Model
{
    protected $table = 'InfoProductHotes';

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
