<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'Banner';
    public $primaryKey = 'BannerID';
    public $timestamps = false;
    // protected $casts = ['BannerID'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Products','StoreProductID','StoreProductID');
    }
}
