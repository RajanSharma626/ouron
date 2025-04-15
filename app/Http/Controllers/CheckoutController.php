<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmationJob;
use App\Jobs\SendOrderSmsJob;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = CartItem::with(['product', 'product.firstImage'])->where('user_id', Auth::id())->get();
        $defaultAddress = UserAddress::where('user_id', Auth::id())->where('default_address', 1)->first();
        return view('frontend.checkout', compact('cart', 'defaultAddress'));
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

        // Remove all non-digit characters from the phone input
        $inputPhone = preg_replace('/\D/', '', $request->phone);

        // If the phone number starts with '91' and is 12 digits long, remove the country code
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }

        // If the phone number is still not exactly 10 digits, return an error
        if (strlen($inputPhone) != 10) {
            return back()->withErrors(['phone' => 'Invalid phone number format.']);
        }

        $request->merge(['phone' => $inputPhone]);

        $cart = CartItem::where('user_id', Auth::id())->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $price = $item->product->discount_price;
            $subtotal += $price * $item->quantity;
        }

        $total = $subtotal;

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
            'phone' => $inputPhone,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
            'total' => $total,
            'status' => 'Pending',
        ]);

        // Save Order Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->discount_price,
                'size' => $item->size,
                'color' => $item->color
            ]);
        }

        // Clear the cart
        CartItem::where('user_id', Auth::id())->delete();

        // Dispatch Email Job
        // SendOrderConfirmationJob::dispatch($order);

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, thank you for shopping with us! Your order #{$order->id} has been successfully placed and is now being processed. We will notify you once it is shipped.";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);


        // 👉 If UPI selected, initiate PhonePe
        if ($request->payment_method === 'UPI') {
            $merchantId = env('PHONEPE_MERCHANT_ID');
            $saltKey = env('PHONEPE_SALT_KEY');
            $saltIndex = env('PHONEPE_SALT_INDEX');
            $baseUrl = env('PHONEPE_BASE_URL');

            Log::info('PhonePe ENV values', [
                'merchantId' => env('PHONEPE_MERCHANT_ID'),
                'saltKey' => env('PHONEPE_SALT_KEY'),
                'saltIndex' => env('PHONEPE_SALT_INDEX'),
            ]);


            $transactionId = 'ORD_' . $order->id . '_' . time();

            Payment::create([
                'order_id' => $order->id,
                'transaction_id' => $transactionId,
                'payment_type' => 'UPI',
                'status' => 'PENDING',
            ]);

            $payload = [
                'merchantId' => $merchantId,
                'merchantTransactionId' => $transactionId,
                'merchantUserId' => 'USER_' . Auth::id(),
                'amount' => (int)($total * 100),
                'redirectUrl' => route('phonepe.callback'),
                'redirectMode' => 'POST',
                'callbackUrl' => route('phonepe.callback'),
                'paymentInstrument' => ['type' => 'PAY_PAGE'],
            ];

            $jsonPayload = json_encode($payload);
            $base64Payload = base64_encode($jsonPayload);
            $checksum = hash('sha256', $base64Payload . "/pg/v1/pay" . $saltKey) . "###" . $saltIndex;

            Log::info('PhonePe Checksum:', ['checksum' => $checksum]);
            Log::info('PhonePe Payload:', ['payload' => $payload, 'encoded' => $base64Payload]);


            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-VERIFY' => $checksum
            ])->post($baseUrl . '/pg/v1/pay', ['request' => $base64Payload]);

            if ($response->successful() && isset($response['data']['instrumentResponse']['redirectInfo']['url'])) {
                return redirect($response['data']['instrumentResponse']['redirectInfo']['url']);
            }

            Log::error('PhonePe payment failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);


            return  redirect()->route('orders.show', $order->id)->with('error', 'Payment failed.');
        }


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
        $defaultAddress = UserAddress::where('user_id', Auth::id())->where('default_address', 1)->first();

        // Store in session (temporary order)
        session(['buy_now' => [
            'name' => $product->name,
            'slug' => $product->slug,
            'img' => $product->firstImage->img,
            'product_id' => $product->id,
            'color' => $request->color,
            'size' => $request->size,
            'price' => $product->discount_price,
            'quantity' => 1,
            'address' => $defaultAddress ? $defaultAddress->address : null,
            'address2' => $defaultAddress ? $defaultAddress->address_2 : null,
            'city' => $defaultAddress ? $defaultAddress->city : null,
            'state' => $defaultAddress ? $defaultAddress->state : null,
            'pin_code' => $defaultAddress ? $defaultAddress->pin_code : null,
        ]]);

        // Redirect to checkout page
        return redirect()->route('buy')->with('defaultAddress', $defaultAddress);
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

        // Remove all non-digit characters from the phone input
        $inputPhone = preg_replace('/\D/', '', $request->phone);

        // If the phone number starts with '91' and is 12 digits long, remove the country code
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }

        // If the phone number is still not exactly 10 digits, return an error
        if (strlen($inputPhone) != 10) {
            return back()->withErrors(['phone' => 'Invalid phone number format.']);
        }

        $request->merge(['phone' => $inputPhone]);

        if (!session()->has('buy_now')) {
            return redirect()->route('home')->with('error', 'No product selected for checkout.');
        }

        $buyNow = session('buy_now');

        // Calculate totals
        $subtotal = $buyNow['price'] * $buyNow['quantity'];
        $total = $subtotal;

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
            'phone' => $inputPhone,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
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


    public function applyCoupon(Request $request)
    {
        $couponCode = strtoupper($request->input('coupon_code'));
        $coupon = Coupon::where('coupon_code', $couponCode)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            return redirect()->route('checkout')->with('coupon_error', 'Invalid or expired coupon code.');
        }

        // Store the coupon discount in session
        session(['discount' => [
            'value' => $coupon->discount_value,
            'type' => $coupon->coupon_type,
            'coupon_code' => $coupon->coupon_code,
        ]]);

        return redirect()->route('checkout')->with('coupon_success', 'Coupon applied successfully!');
    }
}
