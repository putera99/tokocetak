<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSlider extends Model
{
    protected $table = 'BannerSlider';
    public $primaryKey = 'BannerSliderID';
    public $timestamps = false;
    protected $casts = ['BannerSliderID'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
