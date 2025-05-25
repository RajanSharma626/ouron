<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function detail($slug)
    {

        $userId = Auth::id();

        // Fetch product details using the slug, excluding deleted products
        $product = tap(Product::with(['productImg','firstimage','collection','category', 'blog', 'variants'])
            ->where('slug', $slug)
            ->whereNull('deleted_at')
            ->firstOrFail(), function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            });

        $newProducts = Product::with(['firstimage', 'secondimage', 'variants'])
            ->latest()
            ->take(4)
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });


        // Pass the product data to the view
        return view('frontend.product-detail', compact('product', 'newProducts'));
    }
}
