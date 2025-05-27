<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmationJob;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function razorpayCallback(Request $request)
    {
        $razorpayPaymentId = $request->input('razorpay_payment_id');
        $razorpayOrderId = $request->input('razorpay_order_id');

        $payment = Payment::where('transaction_id', $razorpayOrderId)->first();
        if (!$payment) {
            return redirect()->route('checkout')->with('error', 'Payment record not found.');
        }

        // Verify the payment using Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $razorpayPayment = $api->payment->fetch($razorpayPaymentId);
            if ($razorpayPayment['status'] === 'captured') {
                DB::beginTransaction();

                $payload = json_decode($payment->payload, true);
                $isBuyNow = $payload['buy_now'] ?? false;

                $order = Order::create([
                    'user_id' => $payment->user_id,
                    'first_name' => $payload['first_name'],
                    'last_name' => $payload['last_name'],
                    'email' => $payload['email'],
                    'address' => $payload['address'],
                    'address2' => $payload['address2'] ?? null,
                    'city' => $payload['city'],
                    'state' => $payload['state'],
                    'pin_code' => $payload['pin_code'],
                    'phone' => $payload['phone'],
                    'payment_method' => 'UPI',
                    'coupon' => $payload['coupon'] ?? null,
                    'coupon_value' => $payload['coupon_value'] ?? 0,
                    'coupon_type' => $payload['coupon_type'] ?? null,
                    'subtotal' => $payload['subtotal'],
                    'total' => $payload['total'],
                    'status' => 'Pending',
                    'payment_status' => 'Paid',
                    'tax' => $payload['tax'],
                ]);

                $payment->update([
                    'status' => 'SUCCESS',
                    'order_id' => $order->id,
                    'response_payload' => json_encode($razorpayPayment)
                ]);

                if ($isBuyNow) {
                    // Handle buy now product order
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $payload['product_id'],
                        'quantity' => 1,
                        'price' => $payload['subtotal'],
                        'size' => $payload['size'],
                        'color' => $payload['color'],
                    ]);

                    $variant = ProductVariant::where('product_id', $payload['product_id'])
                        ->where('size', $payload['size'])
                        ->first();

                    if ($variant) {
                        $variant->stock -= 1;
                        $variant->save();
                    }
                } else {
                    // Cart flow
                    $cart = CartItem::where('user_id', $payment->user_id)->get();

                    foreach ($cart as $item) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                            'price' => $item->product->discount_price,
                            'size' => $item->size,
                            'color' => $item->color
                        ]);

                        $variant = ProductVariant::where('product_id', $item->product_id)
                            ->where('size', $item->size)
                            ->first();

                        if ($variant) {
                            $variant->stock -= $item->quantity;
                            $variant->save();
                        }
                    }

                    CartItem::where('user_id', $payment->user_id)->delete();
                    session()->forget('discount');
                }

                DB::commit();

                SendOrderConfirmationJob::dispatch($order);

                return response()->json([
                    'status' => 'success',
                    'redirect' => route('order.success', $order->id)
                ]);
            } else {
                return redirect()->route('checkout')->with('error', 'Payment not captured.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Razorpay payment verification failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Payment verification failed.');
        }
    }
}
