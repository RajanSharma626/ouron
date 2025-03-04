<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'category',
        'images',
        'status'
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
