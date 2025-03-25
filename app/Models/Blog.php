<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_desc',
        'banner_image',
        'cover_image',
        'blog_content',
        'qr_code',
        'slug',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
