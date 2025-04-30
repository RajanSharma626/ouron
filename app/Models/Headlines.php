<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headlines extends Model
{

    protected $table = "headlines";
    protected $fillable = [
        'headline',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
