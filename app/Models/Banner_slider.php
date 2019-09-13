<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner_slider extends Model
{
    protected $table = 'banner_slider';
    public $primaryKey = 'banner_slider_id';
    public $timestamps = false;
    protected $casts = ['banner_slider_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
