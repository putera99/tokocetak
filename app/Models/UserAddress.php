<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'UserAddress';
    public $primaryKey = 'UserAddressID';
    public $timestamps = false;
    protected $casts = ['UserAddressID'=>'string'];
    protected $fillable = [
        'IsDefault'
    ];

    public function postal_code(){
    	return $this->hasOne('App\Models\PostalCode','ID','PostalCodeID');
    }

    public function provinsi(){
    	return $this->hasOne('App\Models\Provinsi','Code','ProvinceCode');
    }

    public function user(){
    	return $this->hasOne('App\User','id','UserID');
    }

}
