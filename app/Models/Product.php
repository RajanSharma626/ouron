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
        'sizes',
        'colors',
        'discount_price',
        'stock',
        'sku',
        'category_id',
        'images',
        'status'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function firstimage()
    {
        return $this->hasOne(ProductImg::class, 'product_id')->orderBy('id', 'asc');
    }

    public function secondimage()
    {
        return $this->hasOne(ProductImg::class, 'product_id')->orderBy('id', 'asc')->skip(1)->take(1);
    }

    public function likes()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }
}
