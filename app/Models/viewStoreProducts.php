<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class viewStoreProducts extends Model
{
    protected $table = 'viewStoreProducts';

    public function gambar(){
    	return $this->hasOne('\App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }

    public function kategori(){
    	return $this->belongsTo('App\Models\ProductCategories','ProductCategoryID','ID');
    }
}
