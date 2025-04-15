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

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('admin.category-edit', compact('category'));
        }
        return redirect()->route('admin.category')->with('error', 'Category not found!');
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

    public function update(Request $request)
    {
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'category-title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meta-title' => 'nullable|string',
            'meta-tag' => 'nullable|string',
            'meta-description' => 'nullable|string',
        ]);
        $category = Category::find($request->input('id'));
        if ($category) {
            // Handle Image Upload
            if ($request->hasFile('file')) {
                $imageName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('uploads/categories'), $imageName);
                $imageName = 'uploads/categories/' . $imageName; // Store full path in database
                $category->image = $imageName;
            }

            // Update category
            $category->name = $request->input('category-title');
            $category->slug = Str::slug($request->input('category-title'));
            $category->description = $request->input('description');
            $category->meta_title = $request->input('meta-title');
            $category->meta_keywords = $request->input('meta-tag');
            $category->meta_description = $request->input('meta-description');
            $category->save();

            return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
        } else {
            return redirect()->route('admin.category')->with('error', 'Category not found!');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('admin.category')->with('success', 'Category deleted successfully!');
        }
        return redirect()->route('admin.category')->with('error', 'Category not found!');
    }
}
