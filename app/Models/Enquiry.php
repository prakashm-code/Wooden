<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'state',
        'city',
        'product',
        'message',
    ];
}
