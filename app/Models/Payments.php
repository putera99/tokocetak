<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'Payments';
    public $primaryKey = 'ID';
    public $timestamps = false;
    protected $casts = ['ID'=>'string'];
}
