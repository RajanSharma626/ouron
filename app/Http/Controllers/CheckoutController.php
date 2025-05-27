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
use App\Models\ProductVariant;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = CartItem::where('user_id', Auth::id())
            ->with(['product', 'product.firstImage', 'product.variants'])
            ->get()
            ->filter(function ($item) {
                $variant = $item->product->variants->firstWhere('size', $item->size);
                return $variant && $variant->stock >= $item->quantity;
            });

        $defaultAddress = UserAddress::where('user_id', Auth::id())->where('default_address', 1)->first();

        // Check if there's a coupon in session
        if (session()->has('discount')) {
            $couponCode = session('discount.coupon_code');
            $coupon = Coupon::where('coupon_code', $couponCode)
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            $isValid = false;

            if ($coupon) {
                foreach ($cart as $item) {
                    $product = $item->product;

                    switch ($coupon->for_type) {
                        case 'all':
                            $isValid = true;
                            break;
                        case 'category':
                            $isValid = ($coupon->category_id == NULL || $coupon->category_id == $product->category_id);
                            break;
                        case 'collection':
                            $isValid = ($coupon->collection_id == NULL || $coupon->collection_id == $product->collection_id);
                            break;
                        case 'product':
                            $isValid = ($coupon->product_id == NULL || $coupon->product_id == $product->id);
                            break;
                    }

                    if ($isValid) break;
                }
            }

            // If invalid, remove from session and flash message
            if (!$isValid) {
                session()->forget('discount');
            }
        }

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

        $pincodeCheck = $this->checkPincode($request->pin_code);

        if (is_array($pincodeCheck) && isset($pincodeCheck['status']) && !$pincodeCheck['status']) {
            return redirect()->back()->withErrors(['pin_code' => $pincodeCheck['message'] ?? 'Delivery is not available at this PIN code.']);
        }

        $inputPhone = preg_replace('/\D/', '', $request->phone);
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }
        if (strlen($inputPhone) != 10) {
            return redirect()->route('checkout')->withErrors(['phone' => 'Invalid phone number format.']);
        }

        $cart = CartItem::where('user_id', Auth::id())->get();
        if ($cart->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item->product->discount_price * $item->quantity;
        }

        if (session()->has('discount')) {
            $discount = session('discount');

            $coupon = Coupon::where('coupon_code', $discount['coupon_code'])
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();
            if (!$coupon) {
                session()->forget('discount');
                return redirect()->route('checkout')->with('coupon_error', 'Invalid or expired coupon code.');
            } else {
                $couponCode = $discount['coupon_code'];
                $couponType = $discount['type'];

                if ($discount['type'] === 'percentage') {
                    $discountAmount = ($subtotal * $discount['value']) / 100;
                } elseif ($discount['type'] === 'fixed_amount') {
                    $discountAmount = $discount['value'];
                } else {
                    $discountAmount = 0;
                }
                $couponValue = $discountAmount;
                $total = $subtotal - $discountAmount;
            }
        } else {
            $discountAmount = 0;
            $total = $subtotal;
        }


        $tax = $total < 1000 ? $total * 0.05 : $total * 0.12; // 5% tax for total under 1000, 12% for 1000 and above

        $defaultAddress = UserAddress::where('user_id', Auth::id())->first();

        if (!$defaultAddress) {
            $defaultAddress = UserAddress::create([
                'user_id' => Auth::id(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'address_2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'pin_code' => $request->pin_code,
                'phone' => $inputPhone,
                'default_address' => 1,
            ]);
        }

        // Check if the user has an email, if not, update it
        $user = Auth::user();
        if (!$user->email) {
            $user->update(['email' => $request->email]);
        }

        if ($request->payment_method === 'UPI') {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => 'ORD' . Auth::id() . time(),
                'amount' => (int)($total * 100), // Amount in paise
                'currency' => 'INR',
            ]);

            // Save payment info
            Payment::create([
                'transaction_id' => $razorpayOrder['id'],
                'payment_type' => 'UPI',
                'status' => 'PENDING',
                'user_id' => Auth::id(),
                'payload' => json_encode([
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
                    'coupon' => $couponCode ?? null,
                    'coupon_value' => $couponValue ?? null,
                    'coupon_type' => $couponType ?? null,
                    'subtotal' => $subtotal,
                    'total' => $total,
                    'tax' => $tax,
                ])
            ]);

            // Redirect to payment page (could be a view with Razorpay checkout script)
            return view('razorpay.checkout', [
                'order_id' => $razorpayOrder['id'],
                'razorpay_key' => env('RAZORPAY_KEY'),
                'amount' => $total * 100,
                'name' => $request->first_name,
                'email' => $request->email,
                'phone' => $inputPhone,
            ]);
        } elseif ($request->payment_method == 'COD') {
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
                'coupon' => $couponCode ?? null,
                'coupon_value' => $couponValue ?? null,
                'coupon_type' => $couponType ?? null,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'Pending',
                'tax' => $tax,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->discount_price,
                    'size' => $item->size ?? null,
                    'color' => $item->color ?? null
                ]);

                // Deduct stock from product table
                $variant = ProductVariant::where('product_id', $item->product_id)->where('size', $item->size)->first();

                if ($variant) {
                    $variant->stock -= $item->quantity;
                    $variant->save();
                }
            }

            SendOrderConfirmationJob::dispatch($order);

            CartItem::where('user_id', Auth::id())->delete();
            session()->forget('discount');

            return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
        }

        return back()->with('error', 'Unsupported payment method.');
    }


    // public function buy($productSlug)
    // {

    //     if (!session()->has('buy_now')) {
    //         return redirect()->route('home')->with('error', 'No product selected for checkout.');
    //     }
    //     return view('frontend.buy-now');
    // }

    public function buyNow(Request $request)
    {

        $request->validate([
            'color' => 'required',
            'size' => 'required',
            'id' => 'required|exists:products,id'
        ]);

        // Fetch the product details
        $product = Product::with('firstImage', 'variants')->findOrFail($request->id);
        $variant = $product->variants()
            ->where('size', $request->size)
            ->first();

        // If variant does not exist or stock is 0
        if (!$variant || $variant->stock < 1) {
            return redirect()->route('product.detail',)->with('error', 'Selected variant is out of stock.');
        }

        $defaultAddress = UserAddress::where('user_id', Auth::id())->where('default_address', 1)->first();

        $color = $request->color;
        $size = $request->size;

        // Check if there's a coupon in session
        if (session()->has('discount')) {
            $couponCode = session('discount.coupon_code');
            $coupon = Coupon::where('coupon_code', $couponCode)
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            $isValid = false;

            if ($coupon) {

                switch ($coupon->for_type) {
                    case 'all':
                        $isValid = true;
                        break;
                    case 'category':
                        $isValid = ($coupon->category_id == NULL || $coupon->category_id == $product->category_id);
                        break;
                    case 'collection':
                        $isValid = ($coupon->collection_id == NULL || $coupon->collection_id == $product->collection_id);
                        break;
                    case 'product':
                        $isValid = ($coupon->product_id == NULL || $coupon->product_id == $product->id);
                        break;
                }
            }

            // If invalid, remove from session and flash message
            if (!$isValid) {
                session()->forget('discount');
            }
        }

        return view('frontend.buy-now', compact('color', 'size', 'product', 'defaultAddress'));
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
            'payment_method' => 'required',
            'color' => 'required',
            'size' => 'required',
            'product_id' => 'required|exists:products,id'
        ]);

        $pincodeCheck = $this->checkPincode($request->pin_code);

        if (is_array($pincodeCheck) && isset($pincodeCheck['status']) && !$pincodeCheck['status']) {
            return redirect()->back()->withErrors(['pin_code' => $pincodeCheck['message'] ?? 'Delivery is not available at this PIN code.']);
        }

        $inputPhone = preg_replace('/\D/', '', $request->phone);
        if (strlen($inputPhone) == 12 && substr($inputPhone, 0, 2) == '91') {
            $inputPhone = substr($inputPhone, 2);
        }
        if (strlen($inputPhone) != 10) {
            return redirect()->back()->withErrors(['phone' => 'Invalid phone number format.']);
        }

        $product = Product::with('variants')->findOrFail($request->product_id);
        $variant = $product->variants()->where('size', $request->size)->first();

        if (!$variant || $variant->stock < 1) {
            return redirect()->back()->with('error', 'Selected variant is out of stock.');
        }

        $subtotal = $product->discount_price;

        if (session()->has('discount')) {
            $discount = session('discount');

            $coupon = Coupon::where('coupon_code', $discount['coupon_code'])
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();
            if (!$coupon) {
                session()->forget('discount');
                return redirect()->back()->with('coupon_error', 'Invalid or expired coupon code.');
            } else {
                $couponCode = $discount['coupon_code'];
                $couponType = $discount['type'];

                if ($discount['type'] === 'percentage') {
                    $discountAmount = ($subtotal * $discount['value']) / 100;
                } elseif ($discount['type'] === 'fixed_amount') {
                    $discountAmount = $discount['value'];
                } else {
                    $discountAmount = 0;
                }
                $couponValue = $discountAmount;
                $total = $subtotal - $discountAmount;
            }
        } else {
            $discountAmount = 0;
            $total = $subtotal;
        }

        $tax = $total < 1000 ? $total * 0.05 : $total * 0.12;

        if ($request->payment_method === 'UPI') {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => 'ORD' . Auth::id() . time(),
                'amount' => (int)($total * 100), // Amount in paise
                'currency' => 'INR',
            ]);

            // Save payment info
            Payment::create([
                'transaction_id' => $razorpayOrder['id'],
                'payment_type' => 'UPI',
                'status' => 'PENDING',
                'user_id' => Auth::id(),
                'payload' => json_encode([
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
                    'coupon' => $couponCode ?? null,
                    'coupon_value' => $couponValue ?? null,
                    'coupon_type' => $couponType ?? null,
                    'subtotal' => $subtotal,
                    'total' => $total,
                    'tax' => $tax,
                    'buy_now' => true,
                    'product_id' => $product->id,
                    'size' => $request->size,
                    'color' => $request->color
                ])
            ]);

            // Redirect to payment page (could be a view with Razorpay checkout script)
            return view('razorpay.checkout', [
                'order_id' => $razorpayOrder['id'],
                'razorpay_key' => env('RAZORPAY_KEY'),
                'amount' => $total * 100,
                'name' => $request->first_name,
                'email' => $request->email,
                'phone' => $inputPhone,
            ]);
        } elseif ($request->payment_method == 'COD') {
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
                'coupon' => $couponCode ?? null,
                'coupon_value' => $couponValue ?? null,
                'coupon_type' => $couponType ?? null,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'Pending',
                'tax' => $tax,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->discount_price,
                'size' => $request->size,
                'color' => $request->color
            ]);

            $variant->stock -= 1;
            $variant->save();

            SendOrderConfirmationJob::dispatch($order);
            session()->forget('discount');

            return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
        }

        return back()->with('error', 'Unsupported payment method.');
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
            return redirect()->back()->with('coupon_error', 'Invalid or expired coupon code.');
        }

        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();

        $isValid = false;

        foreach ($cartItems as $item) {
            $product = $item->product;

            switch ($coupon->for_type) {
                case 'all':
                    $isValid = true;
                    break;
                case 'category':
                    $isValid = ($coupon->category_id == NULL || $coupon->category_id == $product->category_id);
                    break;
                case 'collection':
                    $isValid = ($coupon->collection_id == NULL || $coupon->collection_id == $product->collection_id);
                    break;
                case 'product':
                    $isValid = ($coupon->product_id == NULL || $coupon->product_id == $product->id);
                    break;
            }

            if ($isValid) break; // No need to check further if valid
        }

        if (!$isValid) {
            return redirect()->back()->with('coupon_error', 'Invalid Coupon');
        }

        session(['discount' => [
            'value' => $coupon->discount_value,
            'type' => $coupon->coupon_type,
            'coupon_code' => $coupon->coupon_code,
        ]]);

        return redirect()->back()->with('coupon_success', 'Coupon applied successfully!');
    }

    public function applyBuyCoupon(Request $request)
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

        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();

        $isValid = false;

        foreach ($cartItems as $item) {
            $product = $item->product;

            switch ($coupon->for_type) {
                case 'all':
                    $isValid = true;
                    break;
                case 'category':
                    $isValid = ($coupon->category_id == NULL || $coupon->category_id == $product->category_id);
                    break;
                case 'collection':
                    $isValid = ($coupon->collection_id == NULL || $coupon->collection_id == $product->collection_id);
                    break;
                case 'product':
                    $isValid = ($coupon->product_id == NULL || $coupon->product_id == $product->id);
                    break;
            }

            if ($isValid) break; // No need to check further if valid
        }

        if (!$isValid) {
            return redirect()->route('checkout')->with('coupon_error', 'Invalid Coupon');
        }

        session(['discount' => [
            'value' => $coupon->discount_value,
            'type' => $coupon->coupon_type,
            'coupon_code' => $coupon->coupon_code,
        ]]);

        return redirect()->route('checkout')->with('coupon_success', 'Coupon applied successfully!');
    }


    public function removeCoupon()
    {
        if (session()->has('discount')) {
            session()->forget('discount');
            return redirect()->back()->with('coupon_success', 'Coupon removed successfully!');
        }

        return redirect()->back()->with('coupon_error', 'No coupon applied to remove.');
    }

    public function checkPincode($pin)
    {
        $token = $this->getShiprocketToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://apiv2.shiprocket.in/v1/external/courier/serviceability/', [
            'pickup_postcode' => '395006', // your warehouse pincode
            'delivery_postcode' => $pin,
            'cod' => 0,
            'weight' => 1,
            'declared_value' => 500
        ]);

        $data = $response->json();

        // Log for debugging
        // Log::info('Shiprocket Pincode Check', ['response' => $data]);

        if (isset($data['data']['available_courier_companies']) && count($data['data']['available_courier_companies']) > 0) {
            return response()->json(['status' => true]);
        }

        $errorMessage = $data['message'] ?? 'Delivery is not available at this PIN code';
        return response()->json([
            'status' => false,
            'message' => $errorMessage
        ]);
    }




    private function getShiprocketToken()
    {
        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'email' => env('SHIPROCKET_EMAIL'),
            'password' => env('SHIPROCKET_PASSWORD'),
        ]);

        return $response['token'];
    }
}
