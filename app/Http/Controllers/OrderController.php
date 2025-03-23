<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index()
    {
        return view('admin.orders');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pin_code' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $subtotal = 100; // Calculate subtotal from cart
        $tax = 10; // Define tax amount
        $discount = 0;

        // Check for applied coupon
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon['discount_type'] === 'percentage') {
                $discount = ($subtotal * $coupon['discount']) / 100;
            } else {
                $discount = $coupon['discount'];
            }

            // Update coupon usage
            Coupon::where('code', $coupon['code'])->increment('used');
        }

        $total = $subtotal + $tax - $discount;

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Clear coupon session
        Session::forget('coupon');

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }
}
