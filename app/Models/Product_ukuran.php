<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_ukuran extends Model
{
    protected $table = 'product_ukuran';
    public $primaryKey = 'product_ukuran_id';
    public $timestamps = false;
    protected $casts = ['product_ukuran_id'=>'string'];

    public function ukuran(){
    	return $this->belongsTo('App\Models\Ukuran','ukuran_id','ukuran_id');
    }
}
