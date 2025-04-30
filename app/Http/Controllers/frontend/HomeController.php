<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $userId = Auth::id();

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


        $allProducts = Product::with(['firstimage', 'secondimage', 'variants'])
            ->latest()
            ->take(8)
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });


        $bestSellerProducts = Product::with(['firstimage', 'secondimage', 'variants'])
            ->latest()
            ->take(8)
            ->whereNull('deleted_at')
            ->where('best_seller', 1)
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        $blogs = Blog::latest()->take(4)->get();

        return view('frontend.home', compact('newProducts', 'allProducts', 'bestSellerProducts', 'blogs'));
    }
}
