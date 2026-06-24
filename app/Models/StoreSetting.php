<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'gst_number',
        'logo',
        'favicon',
        'website',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'whatsapp',
        'created_at',
        'updated_at',


    ];
}
