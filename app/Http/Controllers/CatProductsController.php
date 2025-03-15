<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatProductsController extends Controller
{
    public function allProduct()
    {
        $products = Product::whereNull('deleted_at')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.products', compact('products'));
    }

    public function newIn()
    {
        $products = Product::whereNull('deleted_at')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.new-products', compact('products'));
    }
}
