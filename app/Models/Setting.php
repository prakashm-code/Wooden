<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'total_tables',
        'restaurant_name',
        'address',
        'phone',
        'email',
        'gst_percentage',
        'parcel_charge_per_item',
        'total_tables'
    ];
}
