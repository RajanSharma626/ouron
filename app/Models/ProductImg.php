<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    protected $table = 'product_img';
    protected $fillable = [
        'product_id',
        'img',
        'is_main',
        'sort',
    ];
}
