<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plywood extends Model
{

    protected $fillable = [
        'name',
        'price',
        'market_price',
        'is_active',
        'image',
    ];
}
