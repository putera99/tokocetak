<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'Wishlist';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['id'=>'string'];
}
