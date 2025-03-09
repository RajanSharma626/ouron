<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('deleted_at')->paginate(10);
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category-title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meta-title' => 'nullable|string',
            'meta-tag' => 'nullable|string',
            'meta-description' => 'nullable|string',
        ]);

        // Handle Image Upload
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/categories'), $imageName);
            $imageName = 'uploads/categories/' . $imageName; // Store full path in database
        } else {
            $imageName = null;
        }

        // Save category
        $category = new Category();
        $category->name = $request->input('category-title');
        $category->slug = Str::slug($request->input('category-title'));
        $category->description = $request->input('description');
        $category->image = $imageName;
        $category->meta_title = $request->input('meta-title');
        $category->meta_keywords = $request->input('meta-tag');
        $category->meta_description = $request->input('meta-description');
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category created successfully!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->deleted_at = now();
            $category->save();
            return redirect()->route('admin.category')->with('success', 'Category deleted successfully!');
        }
        return redirect()->route('admin.category')->with('error', 'Category not found!');
    }
}
