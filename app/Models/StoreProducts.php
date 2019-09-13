<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProducts extends Model
{
    protected $table = 'StoreProducts';
    public $primaryKey = 'StoreProducID';
    protected $casts = ['StoreProducID'=>'string'];

    public function gambar(){
    	return $this->hasOne('\App\Models\viewStoreProducts','StoreProducID','StoreProducID');
    }

    public function kategori(){
    	return $this->belongsTo('App\Models\viewStoreProducts','StoreProducID','StoreProducID');
    }
}
