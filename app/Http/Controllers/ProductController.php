<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereNull('deleted_at')
            ->with(['category', 'firstimage'])
            ->paginate(10);
        return view('admin.product', compact('products'));
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function add()
    {
        $categories = Category::whereNull('deleted_at')->get();
        return view('admin.product-add', compact('categories'));
    }


    public function edit($id)
    {
        $categories = Category::whereNull('deleted_at')->get();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found');
        };
        return view('admin.product-edit', compact('categories', 'product'));
    }



    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_category' => 'nullable|string',
            'size' => 'nullable|array',
            'size.*' => 'string',
            'color' => 'nullable|array',
            'color.*' => 'string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product = Product::create([
            'name' => $request->product_name,
            'slug' => \Illuminate\Support\Str::slug($request->product_name),
            'description' => $request->description,
            'price' => $request->product_price,
            'discount_price' => $request->discount_price,
            'stock' => $request->product_stock,
            'sku' => $request->sku,
            'category_id' => $request->product_category,
            'sizes' => json_encode($request->size),
            'colors' => json_encode($request->color),
            'status' => 'active',
        ]);

        // Process images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $index => $image) {
                if (!$image->isValid()) {
                    return back()->withErrors(['images' => 'Invalid file uploaded.']);
                }
                $imagePaths[] = $this->storeProductImages($image, $product->id, $index == 0);
            }
            $product->update(['images' => json_encode($imagePaths)]);
        } else {
            return back()->withErrors(['images' => 'No images found in request.']);
        }


        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    private function storeProductImages($image, $product_id, $is_main)
    {
        if (!$image->isValid()) {
            Log::error('Invalid image file detected.');
            return;
        }

        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path("uploads/products/");

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Save the original file
        $image->move($destinationPath, $filename);

        // Create multiple sizes
        $sizes = [
            '165' => 165,
            '360' => 360,
            '533' => 533,
            '720' => 720,
            '940' => 940,
            '1066' => 1066,
            '1080' => 1080
        ];

        $manager = new ImageManager(new Driver());
        $originalImage = $manager->read($destinationPath . $filename);

        foreach ($sizes as $key => $width) {
            $resizedImage = $originalImage->scale($width);
            $resizedImage->save("{$destinationPath}{$key}_{$filename}", quality: 75); // Adjust quality as needed
        }

        // Store in database (use base path without 'uploads/')
        ProductImg::create([
            'product_id' => $product_id,
            'img' => "/uploads/products/{$filename}",
            'is_main' => $is_main,
            'sort' => 0,
        ]);
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

        $product->deleted_at = now();
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
