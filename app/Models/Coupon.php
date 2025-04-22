<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'coupon_code',
        'for_type',
        'category_id',
        'collection_id',
        'product_id',
        'discount_value',
        'coupon_type',
        'status',
        'start_date',
        'end_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collections::class, 'collection_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
