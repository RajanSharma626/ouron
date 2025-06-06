<?php

namespace App\Http\Controllers;

use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collections::orderby('id', 'desc')->paginate(10);
        return view('admin.collection', compact('collections'));
    }

    public function edit($id){
        $collections = Collections::where('id', $id)->first();
        return view('admin.collection-edit', compact('collections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'collection-title' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta-title' => 'nullable|string',
            'meta-tag' => 'nullable|string',
            'meta-description' => 'nullable|string',
        ]);

        // Handle Image Upload
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/collection'), $imageName);
            $imageName = 'uploads/collection/' . $imageName; // Store full path in database
        } else {
            $imageName = null;
        }

        $collection = new Collections();
        $collection->name = $request->input('collection-title');
        $collection->slug = Str::slug($request->input('collection-title'));
        $collection->description = $request->description;
        $collection->image = $imageName;
        $collection->meta_title = $request->input('meta-title');
        $collection->meta_keywords = $request->input('meta-tag');
        $collection->meta_description = $request->input('meta-description');


        $collection->save();

        return redirect()->route('admin.collection')->with('success', 'Collection created successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'collection-title' => 'required',
            'description' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta-title' => 'nullable|string',
            'meta-tag' => 'nullable|string',
            'meta-description' => 'nullable|string',
        ]);

        // Handle Image Upload
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/collection'), $imageName);
            $imageName = 'uploads/collection/' . $imageName; // Store full path in database
        } else {
            $imageName = null;
        }

        $collection = Collections::find($request->input('id'));
        if ($collection) {
            $collection->name = $request->input('collection-title');
            $collection->slug = Str::slug($request->input('collection-title'));
            $collection->description = $request->description;
            if ($imageName) {
                $collection->image = $imageName;
            }
            $collection->meta_title = $request->input('meta-title');
            $collection->meta_keywords = $request->input('meta-tag');
            $collection->meta_description = $request->input('meta-description');

            $collection->save();

            return redirect()->route('admin.collection')->with('success', 'Collection updated successfully.');
        } else {
            return redirect()->route('admin.collection')->with('error', 'Collection not found.');
        }
    }
    public function destroy($id)
    {
        $collection = Collections::find($id);
        if ($collection) {
            $collection->delete();
            return redirect()->route('admin.collection')->with('success', 'Collection deleted successfully.');
        } else {
            return redirect()->route('admin.collection')->with('error', 'Collection not found.');
        }
    }    
}
