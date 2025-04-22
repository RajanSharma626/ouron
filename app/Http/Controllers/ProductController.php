<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collections;
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
            ->with(['category', 'firstimage', 'variants'])
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
        $collections = Collections::whereNull('deleted_at')->get();
        return view('admin.product-add', compact('categories', 'collections'));
    }


    public function edit($id)
    {
        $categories = Category::whereNull('deleted_at')->get();
        $collections = Collections::whereNull('deleted_at')->get();
        $product = Product::with('productImg', 'variants')->find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found');
        };
        return view('admin.product-edit', compact('categories', 'product', 'collections'));
    }


    public function stock()
    {
        $products = Product::whereNull('deleted_at')
            ->with(['category', 'firstimage', 'variants'])
            ->paginate(10);
        return view('admin.stock', compact('products'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'product_category' => 'nullable|string',
            'bestSeller' => 'nullable|string',
            'product_weight' => 'required|string',
            'color' => 'nullable|array',
            'color.*' => 'string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product = Product::create([
            'name' => $request->product_name,
            'slug' => \Illuminate\Support\Str::slug($request->product_name) . '-' . uniqid(),
            'description' => $request->description,
            'detail' => $request->detail,
            'shipping_Return' => $request->shipping_Return,
            'price' => $request->product_price,
            'discount_price' => $request->discount_price,
            'gender' => $request->gender,
            'weight' => $request->product_weight,
            'collection_id' => $request->product_collection,
            'best_seller' => $request->bestSeller,
            'category_id' => $request->product_category,
            'colors' => json_encode($request->color),
            'status' => 'active',
        ]);

        foreach ($request->size_stock as $size => $stock) {
            if ($stock > 0) {
                $product->variants()->create([
                    'size' => $size,
                    'stock' => $stock,
                ]);
            }
        }

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
            $resizedImage->save("{$destinationPath}{$key}_{$filename}", quality: 85);
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
    public function update(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'product_weight' => 'required|string',
            'product_category' => 'nullable|string',
            'bestSeller' => 'nullable|integer',
            'color' => 'nullable|array',
            'color.*' => 'string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product->update([
            'name' => $request->product_name,
            'description' => $request->description,
            'detail' => $request->detail,
            'shipping_Return' => $request->shipping_Return,
            'price' => $request->product_price,
            'discount_price' => $request->discount_price,
            'gender' => $request->gender,
            'weight' => $request->product_weight,
            'collection_id' => $request->product_collection,
            'best_seller' => $request->bestSeller,
            'category_id' => $request->product_category,
            'colors' => json_encode($request->color),
            'status' => $request->status ?? $product->status,
        ]);

        foreach ($request->size_stock as $size => $stock) {
            if ($stock > 0) {
                // Update if exists, else create
                $product->variants()->updateOrCreate(
                    ['size' => $size],
                    ['stock' => $stock]
                );
            } else {
                // If stock is 0, delete variant if exists
                $product->variants()->where('size', $size)->delete();
            }
        }


        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $index => $image) {
                if (!$image->isValid()) {
                    return back()->withErrors(['images' => 'Invalid file uploaded.']);
                }
                $imagePaths[] = $this->storeProductImages($image, $product->id, $index == 0);
            }
            $product->update(['images' => json_encode($imagePaths)]);
        }

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

    // Delete product image
    public function deleteImage($id)
    {
        $productImg = ProductImg::find($id);
        if (!$productImg) {
            return redirect()->back()->with('error', 'Image not found');
        }

        // Delete the image file
        Storage::delete($productImg->img);

        // Delete the record from the database
        $productImg->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }


    public function downloadCSV()
    {
        $products = Product::with('category', 'collection', 'variants')->get();

        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['ID', 'Name', 'Size', 'Category', 'Collection',  'Price', 'Discount Price', 'Weight', 'Colors']);

        foreach ($products as $product) {
            fputcsv($handle, [
                $product->id,
                $product->name,
                $product->variants->map(function ($variant) {
                    return $variant->size . ' (' . $variant->stock . ')';
                })->implode(', '),
                optional($product->category)->name,
                optional($product->collection)->name,
                $product->price,
                $product->discount_price,
                $product->weight,
                collect(json_decode($product->colors))->implode(', '),
            ]);
        }

        rewind($handle);

        return response()->stream(
            function () use ($handle) {
                fpassthru($handle);
            },
            200,
            $headers
        );
    }
}
