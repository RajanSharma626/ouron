<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = "news_letter";
    protected $fillable = [
        'email',
    ];
}
