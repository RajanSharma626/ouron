<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Example Product',
            'slug' => 'example-product',
            'description' => 'This is a sample product description.',
            'price' => 100.00,
            'discount_price' => 90.00,
            'stock' => 50,
            'sku' => 'PROD12345',
            'category_id' => '1',
            'images' => json_encode(["image1.jpg", "image2.jpg"]),
            'status' => 'active',
        ]);
    }
}
