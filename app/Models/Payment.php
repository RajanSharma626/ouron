<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = [
        'order_id',
        'transaction_id',
        'payment_type',
        'status',
        'response_payload',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
