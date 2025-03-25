<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = CartItem::with(['product', 'product.firstImage'])->where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required',
            'phone' => 'required',
            'payment_method' => 'required'
        ]);

        $cart = CartItem::where('user_id', Auth::id())->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $price = $item->product->price - ($item->product->price * $item->product->discount_price) / 100;
            $subtotal += $price * $item->quantity;
        }
        $tax = $subtotal * 0.18; // 18% GST
        $total = $subtotal + $tax;

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'Pending',
        ]);

        // Save Order Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price - ($item->product->price * $item->product->discount_price) / 100,
            ]);
        }

        // Clear the cart
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }
}
