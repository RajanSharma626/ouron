<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatProductsController extends Controller
{
    public function allProduct(Request $request)
    {
        $userId = Auth::id();
        $filter = $request->query('filter', '');

        if ($filter === 'new-in') {
            $pageTitle = 'New In';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc');
        } elseif ($filter === 'best-seller') {
            $pageTitle = 'Best Seller';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->where('best_seller', true)
                ->orderBy('created_at', 'desc');
        } elseif ($filter === 'high-to-low') {
            $pageTitle = 'Price: High to Low';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('(price - (price * discount_price / 100)) desc');
        } elseif ($filter === 'low-to-high') {
            $pageTitle = 'Price: Low to High';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('(price - (price * discount_price / 100)) asc');
        } else {
            $pageTitle = 'All Products';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function newIn()
    {
        // Optionally, you can remove or repurpose this method now that filtering is handled in allProduct.
        $userId = Auth::id();
        $pageTitle = 'New In';

        $products = Product::with(['firstimage', 'secondimage'])
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) use ($userId) {
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function bestSellerProduct()
    {
        $userId = Auth::id();
        $pageTitle = 'Best Seller';

        $products = Product::with(['firstimage', 'secondimage'])
            ->whereNull('deleted_at')
            ->where('best_seller', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) use ($userId) {
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
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }
    public function collectionProduct($cat)
    {
        $userId = Auth::id();

        if ($cat == "edge-by-ouron") {
            $pageTitle = 'Edge by ouron Collection';
        } elseif ($cat == "legacy-origins") {
            $pageTitle = 'Legacy:Origins Collection';
        };


        $products = Product::with(['firstimage', 'secondimage'])
            ->where('collection', $cat)
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle'));
    }
}
