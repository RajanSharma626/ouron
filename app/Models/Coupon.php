<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'discount_type',
        'usage_limit',
        'used',
        'expires_at'
    ];

    public function isValid()
    {
        return ($this->usage_limit > $this->used) && (!$this->expires_at || now()->lt($this->expires_at));
    }
}
