<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Populer_minggu extends Model
{
    protected $table = 'populer_minggu';
    public $primaryKey = 'populer_minggu_id';
    protected $casts = ['populer_minggu_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
