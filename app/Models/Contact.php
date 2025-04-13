<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contact_form";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'comment',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
}
