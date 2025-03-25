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
        'coupon_limits',
        'discount_value',
        'coupon_type',
        'status',
        'start_date',
        'end_date'
    ];
}
