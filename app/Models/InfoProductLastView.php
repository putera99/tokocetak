<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoProductLastView extends Model
{
    protected $table = 'InfoProductLastView';

    public function produk(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProductID','StoreProductID');
    }
}
