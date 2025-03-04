<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product', compact('products'));
    }


    public function create()
    {
        return view('admin.products.create');
    }


    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|unique:products,sku',
            'category' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'category' => $request->category,
            'images' => json_encode($request->images),
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }


    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'stock' => 'integer',
            'sku' => 'nullable|string|unique:products,sku,' . $id,
            'category' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $product->update([
            'name' => $request->name ?? $product->name,
            'slug' => \Illuminate\Support\Str::slug($request->name) ?? $product->slug,
            'description' => $request->description ?? $product->description,
            'price' => $request->price ?? $product->price,
            'discount_price' => $request->discount_price ?? $product->discount_price,
            'stock' => $request->stock ?? $product->stock,
            'sku' => $request->sku ?? $product->sku,
            'category' => $request->category ?? $product->category,
            'images' => json_encode($request->images) ?? $product->images,
            'status' => $request->status ?? $product->status,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
