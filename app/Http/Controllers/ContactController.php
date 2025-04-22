<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contact-form', compact('contacts'));
    }


    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        Contact::create($request->only('name', 'email', 'phone', 'comment'));

        return response()->json(['status' => 'success']);
    }

    public function downloadCSV()
    {
        $contacts = Contact::all();

        $csvFileName = 'contact-form.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Comment']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->id,
                $contact->name,
                $contact->email,
                $contact->phone,
                $contact->comment,
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
