<?php

namespace App\Http\Controllers;

use App\Models\Headlines;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    public function index()
    {
        // Fetch all headlines from the database
        $headlines = Headlines::orderBy('created_at', 'desc')->paginate(15);

        // Return the view with the headlines data
        return view('admin.headline', compact('headlines'));
    }


    public function create()
    {
        // Return the view to create a new headline
        return view('admin.headline-add');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'headline' => 'required|string|max:255',
            'status' => 'required|in:Active,Draft',
        ]);

        // Create a new headline
        Headlines::create($request->all());

        // Redirect back with success message
        return redirect()->route('admin.headline')->with('success', 'Headline created successfully.');
    }
    public function edit($id)
    {
        // Fetch the headline to edit
        $headline = Headlines::findOrFail($id);

        // Return the view to edit the headline
        return view('admin.headline-edit', compact('headline'));
    }
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'headline' => 'required|string|max:255',
            'status' => 'required|in:Active,Draft',
            'id' => 'required|exists:headlines,id',
        ]);

        // Find the headline and update it
        $headline = Headlines::findOrFail($request->id);
        $headline->update($request->all());

        // Redirect back with success message
        return redirect()->route('admin.headline')->with('success', 'Headline updated successfully.');
    }
    public function destroy($id)
    {
        // Find the headline and delete it
        $headline = Headlines::findOrFail($id);
        $headline->delete();

        // Redirect back with success message
        return redirect()->route('admin.headline')->with('success', 'Headline deleted successfully.');
    }
    public function toggleStatus($id)
    {
        // Find the headline
        $headline = Headlines::findOrFail($id);

        // Toggle the status
        $headline->status = ($headline->status == 'Active') ? 'Draft' : 'Active';
        $headline->save();

        // Redirect back with success message
        return redirect()->route('admin.headline')->with('success', 'Headline status updated successfully.');
    }
}
