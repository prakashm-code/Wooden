<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{

    protected $fillable = [
        'name',
        'price',
        'market_price',
        'is_active',
        'image',
    ];
}
