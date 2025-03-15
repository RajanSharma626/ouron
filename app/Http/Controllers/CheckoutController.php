<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required',
            'payment_method' => 'required',
        ]);

        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->pin_code = $request->pin_code;
        $order->payment_method = $request->payment_method;
        $order->user_id = Auth::id();
        $order->save();

        return redirect()->route('profile')->with('success', 'Order placed successfully');
    }   
}
