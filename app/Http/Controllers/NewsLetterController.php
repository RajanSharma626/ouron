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
        return view('frontend.newsletter');
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
}
