<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collections;
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
                ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            $pageTitle = 'Price: Low to High';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('discount_price asc');
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
    public function collectionProduct($collection)
    {
        $userId = Auth::id();

       
        $pageTitle = ucfirst($collection) . ' Collection';

        $collection = Collections::where('slug', $collection)->first();
        $pageDesc = ucfirst($collection->description);

        $pageHeading = ucfirst($collection->name);

        $collectionLogo = $collection->image;

        if (!$collection) {
            return redirect()->route('home')->with('error', 'Collection not found');
        }


        $products = Product::with(['firstimage', 'secondimage'])
            ->where('collection_id', $collection->id)
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($product) use ($userId) {
                $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
                return $product;
            });

        return view('frontend.products', compact('products', 'pageTitle', 'pageHeading','pageDesc', 'collectionLogo'));
    }
}
