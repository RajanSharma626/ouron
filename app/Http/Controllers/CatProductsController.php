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
        $pageTitle = 'All Products';
        if ($filter === 'new-in') {
            // $pageTitle = 'New In';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc');
        } elseif ($filter === 'best-seller') {
            // $pageTitle = 'Best Seller';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->where('best_seller', true)
                ->orderBy('created_at', 'desc');
        } elseif ($filter === 'high-to-low') {
            // $pageTitle = 'Price: High to Low';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            // $pageTitle = 'Price: Low to High';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('discount_price asc');
        } else {
            // $pageTitle = 'All Products';
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function newIn(Request $request)
    {
        // Optionally, you can remove or repurpose this method now that filtering is handled in allProduct.
        $userId = Auth::id();
        $pageTitle = 'New In';

        $filter = $request->query('filter', '');

        if ($filter === 'high-to-low') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->orderByRaw('discount_price asc');
        } else {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        // $products = Product::with(['firstimage', 'secondimage'])
        //     ->whereNull('deleted_at')
        //     ->orderBy('created_at', 'desc')
        //     ->get()
        //     ->map(function ($product) use ($userId) {
        //         $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
        //         return $product;
        //     });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function bestSellerProduct(Request $request)
    {
        $userId = Auth::id();
        $pageTitle = 'Best Seller';

        $filter = $request->query('filter', '');

        if ($filter === 'high-to-low') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->where('best_seller', true)
                ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->where('best_seller', true)
                ->orderByRaw('discount_price asc');
        } else {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
                ->whereNull('deleted_at')
                ->where('best_seller', true)
                ->orderBy('created_at', 'desc');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        return view('frontend.products', compact('products', 'pageTitle'));
    }

    public function catProduct(Request $request,$cat)
    {
        $userId = Auth::id();
        $pageTitle = ucfirst($cat) . ' Products';

        $category = Category::where('slug', $cat)->first();

        if (!$category) {
            return redirect()->route('home')->with('error', 'Category not found');
        }

        $filter = $request->query('filter', '');

        if ($filter === 'best-seller') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at')
            ->where('best_seller', true)
            ->orderBy('created_at', 'desc');
        } elseif ($filter === 'high-to-low') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at')
            ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at')
            ->orderByRaw('discount_price asc');
        } else {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        return view('frontend.products', compact('products', 'pageTitle'));
    }


    public function collectionProduct(Request $request,$collection)
    {
        $userId = Auth::id();



        $collection = Collections::where('slug', $collection)->first();
        $pageDesc = ucfirst($collection->description);

        $pageTitle = ucfirst($collection->name) . ' Collection';
        $pageHeading = ucfirst($collection->name);

        $collectionLogo = $collection->image;

        if (!$collection) {
            return redirect()->route('home')->with('error', 'Collection not found');
        }


        $filter = $request->query('filter', '');

        if ($filter === 'best-seller') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('collection_id', $collection->id)
            ->whereNull('deleted_at')
            ->where('best_seller', true)
            ->orderBy('created_at', 'desc');
        } elseif ($filter === 'high-to-low') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('collection_id', $collection->id)
            ->whereNull('deleted_at')
            ->orderByRaw('discount_price desc');
        } elseif ($filter === 'low-to-high') {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('collection_id', $collection->id)
            ->whereNull('deleted_at')
            ->orderByRaw('discount_price asc');
        } else {
            $productsQuery = Product::with(['firstimage', 'secondimage'])
            ->where('collection_id', $collection->id)
            ->whereNull('deleted_at');
        }

        $products = $productsQuery->get()->map(function ($product) use ($userId) {
            $product->liked = $userId ? $product->likes()->where('user_id', $userId)->exists() : false;
            return $product;
        });

        return view('frontend.products', compact('products', 'pageTitle', 'pageHeading', 'pageDesc', 'collectionLogo'));
    }
}
