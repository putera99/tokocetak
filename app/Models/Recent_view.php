<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recent_view extends Model
{
    protected $table = 'recent_view';
    public $primaryKey = 'recent_view_id';
    public $timestamps = false;
    protected $casts = ['recent_view_id'=>'string'];

    public function produk(){
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
