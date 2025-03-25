<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatProductsController extends Controller
{
    public function allProduct()
    {
        $userId = Auth::id();
        $pageTitle = 'All Products';

        $products = Product::with(['firstimage', 'secondimage'])
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function newIn()
    {
        $userId = Auth::id();
        $pageTitle = 'New In';

        $products = Product::with(['firstimage', 'secondimage'])
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function catProduct($cat)
    {
        $userId = Auth::id();
        $pageTitle = ucfirst($cat) . ' Products';

        $category = Category::where('slug', $cat)->first();

        if (!$category) {
            return redirect()->route('home')->with('error', 'Category not found');
        }

        $products = Product::with(['firstimage', 'secondimage'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                // Check if the product is liked by the user
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }
}
