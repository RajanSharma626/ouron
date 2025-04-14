<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
   protected $table = "collection"; // Specify the table name if it's different from the model name
   protected $fillable = [
       'name',
       'slug',
       'description',
       'image',
       'meta_title',
       'meta_description',
       'meta_keywords',
   ];


   public function products()
   {
       return $this->hasMany(Product::class, 'collection_id');
   }
}
