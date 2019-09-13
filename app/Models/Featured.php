<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $table = 'featured';
    public $primaryKey = 'featured_id';
    public $timestamps = false;
    protected $casts = ['featured_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
