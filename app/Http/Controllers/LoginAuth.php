<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            // Check if item already exists in user's cart
            $existingItem = CartItem::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->first();

            if ($existingItem) {
                // Increase quantity if product exists in user's cart
                $existingItem->increment('quantity', $item->quantity);

                // Delete the session cart item after merging
                $item->delete();
            } else {
                // Assign user ID to session-based cart item
                $item->update(['user_id' => $userId, 'session_id' => null]);
            }
        }
    }



    public function index()
    {
        return view('frontend.login');
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            // Generate a new OTP
            $user->otp = rand(100000, 999999);
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            // Send OTP to user's phone using a service like Twilio
            $this->sendOtpToPhone("+91" . $user->phone, $user->otp);

            return redirect()->route('otp-verify')->with('user_id', $user->id);
        }

        return redirect()->route('login')->with('error', 'Phone number not registered');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'otp' => bcrypt(rand(100000, 999999)), // Encrypt the OTP
            'otp' => rand(100000, 999999), // Encrypt the OTP
            'otp_expires_at' => now()->addMinutes(5) // Set OTP expiration time
        ]);

        // Send OTP to user's phone using a service like Twilio
        $this->sendOtpToPhone("+91" . $user->phone, $user->otp);

        return redirect()->route('otp-verify')->with('user_id', $user->id);
    }

    private function sendOtpToPhone($phone, $otp)
    {
        $sid = "AC891904ce2486cf98dda44f10569189d4";
        $token = "1491eb3f484e2281804d0d351526eb80";
        $twilioPhone = "+19896933126";

        // Debugging: Check if credentials are loaded
        if (!$sid || !$token || !$twilioPhone) {
            Log::error("Twilio credentials are missing in .env");
            throw new \Exception("Twilio credentials are missing. Check your .env file.");
        }

        try {
            $twilio = new \Twilio\Rest\Client($sid, $token);
            $message = $twilio->messages->create($phone, [
                'from' => $twilioPhone,
                'body' => "Your Ouron Login OTP is: $otp"
            ]);
        } catch (\Exception $e) {
            Log::error("Twilio Error: " . $e->getMessage());
            throw new \Exception("Error sending OTP via Twilio: " . $e->getMessage());
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

                // Redirect the user to the intended URL or home if not set
                return redirect()->intended('home')->with('success', 'Logged in successfully');
            } else {
                return redirect()->route('otp-verify')->with('error', 'OTP has expired');
            }
        }

        return redirect()->route('otp-verify')->with('error', 'Invalid OTP');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function profile()
    {
        return view('frontend.profile');
    }
}
