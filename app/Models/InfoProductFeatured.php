<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoProductFeatured extends Model
{
    protected $table = 'InfoProductFeatured';

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
