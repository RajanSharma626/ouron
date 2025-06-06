<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->query('query');

        $results = Product::where('name', 'like', '%' . $query . '%')
            ->take(4)
            ->whereNull('deleted_at')
            ->get(['name', 'slug']);

        return response()->json($results);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $products = Product::whereNull('deleted_at')
            ->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('description', 'like', '%' . $query . '%')
              ->orWhereHas('category', function ($q2) use ($query) {
                  $q2->where('name', 'like', '%' . $query . '%');
              });
            })
            ->get();

        return view('frontend.search', compact('products', 'query'));
    }
}
