<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmationJob;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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
                'size' => $item->size,
                'color' => $item->color
            ]);
        }

        // Clear the cart
        CartItem::where('user_id', Auth::id())->delete();

        // Dispatch Email Job
        SendOrderConfirmationJob::dispatch($order);

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }

    public function buy()
    {

        if (!session()->has('buy_now')) {
            return redirect()->route('home')->with('error', 'No product selected for checkout.');
        }
        return view('frontend.buy-now');
    }

    public function buyNow(Request $request)
    {

        $request->validate([
            'color' => 'required',
            'size' => 'required',
            'id' => 'required|exists:products,id'
        ]);

        // Fetch the product details
        $product = Product::with('firstImage')->findOrFail($request->id);

        // Store in session (temporary order)
        session(['buy_now' => [
            'name' => $product->name,
            'img' => $product->firstImage->img,
            'product_id' => $product->id,
            'color' => $request->color,
            'size' => $request->size,
            'price' => $product->price - ($product->price * $product->discount_price) / 100,
            'quantity' => 1,
        ]]);

        // Redirect to checkout page
        return redirect()->route('buy');
    }

    public function buyNowStore(Request $request)
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

        if (!session()->has('buy_now')) {
            return redirect()->route('home')->with('error', 'No product selected for checkout.');
        }

        $buyNow = session('buy_now');

        // Calculate totals
        $subtotal = $buyNow['price'] * $buyNow['quantity'];
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

        // Save Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $buyNow['product_id'],
            'quantity' => $buyNow['quantity'],
            'price' => $buyNow['price'],
            'size' => $buyNow['size'] ?? null,
            'color' => $buyNow['color'] ?? null,
        ]);

        // Clear Buy Now session
        session()->forget(['buy_now', 'from_buy_now']);

        SendOrderConfirmationJob::dispatch($order);

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }
}
