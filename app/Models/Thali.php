<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thali extends Model
{
    protected $fillable = [
        'name',
        'price',
        'is_active'
    ];

    // Thali has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Thali contains many items (pivot)
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('quantity');
    }
}
