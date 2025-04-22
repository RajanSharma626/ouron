<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\Validator;

class NewsLetterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderBy("created_at","desc")->paginate(10);
        return view('admin.newsletter', compact('newsletters'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:news_letter,email',
        ]);

        if ($validator->fails()) {
            $emailError = $validator->errors()->first('email');
            if (strpos($emailError, 'already been taken') !== false) {
            $emailError = 'This is already subscribed';
            }
            return response()->json([
            'status' => 'error',
            'message' => $emailError
            ], 422);
        }

        // Store in database
        Newsletter::create([
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'You’ve successfully subscribed to Ouron’s newsletter. Stay tuned for something amazing!'
        ]);
    }

    public function downloadCSV()
    {
        $newsletters = Newsletter::all();

        $csvFileName = 'newsletter.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['ID', 'Email']);

        foreach ($newsletters as $newsletter) {
            fputcsv($handle, [
                $newsletter->id,
                $newsletter->email,
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
