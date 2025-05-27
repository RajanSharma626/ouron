<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Brevo\Client\Api\TransactionalSMSApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendTransacSms;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginAuth extends Controller
{

    public function mergeCartOnLogin($oldSessionId, $userId)
    {
        // Get all session-based cart items
        $sessionCartItems = CartItem::where('session_id', $oldSessionId)
            ->where('user_id', null)
            ->get();

        foreach ($sessionCartItems as $item) {
            // Check if item already exists in user's cart with the same product, size, and color
            $existingItem = CartItem::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->where('size', $item->size)
                ->where('color', $item->color)
                ->first();

            if ($existingItem) {
                // Increase quantity if product with the same attributes exists in user's cart
                $existingItem->increment('quantity', $item->quantity);

                // Delete the session cart item after merging
                $item->delete();
            } else {
                // Assign user ID to session-based cart item and clear session ID
                $item->update(['user_id' => $userId, 'session_id' => null]);
            }
        }
    }



    public function index()
    {
        return view('frontend.login');
    }


    public function login(Request $request)
    {
        // Remove all non-digit characters from the phone input
        $inputPhone = preg_replace('/\D/', '', $request->phone);

        // If the phone number starts with '91' and is 12 digits long, remove the country code
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }

        // If the phone number is still not exactly 10 digits, return an error
        if (strlen($inputPhone) != 10) {
            return redirect()->route('login')->with(['phone' => 'Invalid phone number format.']);
        }

        $request->merge(['phone' => $inputPhone]);

        // Lookup user by normalized phone number
        $user = User::where('phone', $inputPhone)->first();

        if ($user) {
            // Generate a new OTP
            $user->otp = rand(100000, 999999);
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            // Send OTP to user's phone using a service like Twilio
            $this->sendOtpToPhone("+91" . $user->phone, $user->otp);

            return redirect()->route('otp-verify')->with('user_id', $user->id);
        } else {
            // Create a new user with normalized phone
            $user = User::create([
                'phone' => $inputPhone,
                'otp' => rand(100000, 999999),
                'otp_expires_at' => now()->addMinutes(5),
                'name' => 'User' . rand(1000, 9999)
            ]);

            // Send OTP to user's phone using a service like Twilio
            $this->sendOtpToPhone("+91" . $user->phone, $user->otp);

            return redirect()->route('otp-verify')->with('user_id', $user->id);
        }
    }

    private function sendOtpToPhone($phone, $otp)
    {
        $apiKey = '6818b17956ac4'; // You should ideally store this in your .env and config/services.php
        $sender = 'OURON';
        $baseUrl = 'https://sms.mobileadz.in/api/push';

        $text = urlencode("Your Ouron OTP: $otp This is your one-time OTP. Every great story starts with a step-use it to continue yours");
        $url = "$baseUrl?apikey=$apiKey&sender=$sender&mobileno=$phone&text=$text";

        try {
            $response = Http::get($url);

            if (!$response->successful()) {
                Log::error("SMS API Error: " . $response->body());
                throw new \Exception("Error sending OTP via MobileAdz: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("SMS Sending Failed: " . $e->getMessage());
            throw new \Exception("Error sending OTP: " . $e->getMessage());
        }
    }



    public function otpVerify()
    {
        return view('frontend.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|numeric'
        ]);

        $user = User::where('id', $request->user_id)->first();

        if ($user->otp == $request->otp) {
            if ($user->otp_expires_at && $user->otp_expires_at->isFuture()) {
                $oldSessionId = session()->getId(); // Store session ID before login

                // OTP is correct and not expired, log the user in
                Auth::login($user);

                $request->session()->regenerate();
                $this->mergeCartOnLogin($oldSessionId, $user->id);; // Merge the cart here

                $user->phone_verified_at = now();
                $user->save();
                // Clear the OTP and expiration time
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->save();

                // Redirect the user to the intended URL or home if not set
                return redirect()->intended('home')->with('success', 'Logged in successfully');
            } else {
                return redirect()->route('otp-verify')->with('error', 'OTP has expired');
            }
        }

        return redirect()->route('otp-verify')->with('error', 'Invalid OTP');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'phone' => 'required|unique:users,phone,' . Auth::id(),
        ]);

        // Normalize the phone number
        $inputPhone = preg_replace('/\D/', '', $request->phone);

        // If the phone number starts with '91' and is 12 digits long, remove the country code
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }

        // If the phone number is still not exactly 10 digits, return an error
        if (strlen($inputPhone) != 10) {
            return back()->withErrors(['phone' => 'Invalid phone number format.']);
        }

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $inputPhone,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function profile()
    {
        $user = Auth::user();
        $defaultAddress = $user->addresses()->where('default_address', true)->first();
        $addresses = $user->addresses()->where('default_address', false)->get();

        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();

        return view('frontend.profile', compact('defaultAddress', 'addresses', 'orders'));
    }
}
