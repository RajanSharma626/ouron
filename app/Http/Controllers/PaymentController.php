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

class PaymentController extends Controller
{
    public function phonepeCallback(Request $request)
    {
        $transactionId = $request->input('transactionId');
        if (!$transactionId) return response()->json(['message' => 'Missing transaction ID'], 400);

        $payment = Payment::where('transaction_id', $transactionId)->first();
        if (!$payment) return response()->json(['message' => 'Payment record not found'], 404);

        // Check if an order already exists for this payment to prevent duplicates
        if ($payment->order_id) {
            $order = Order::find($payment->order_id);
            if ($order) {
                // Order already processed, return appropriate redirect
                if ($order->payment_status === 'Paid') {
                    return redirect()->route('order.success', $order->id);
                } else {
                    return redirect()->route('checkout')->with('error', 'Payment verification in progress.');
                }
            }
        }

        $merchantId = env('PHONEPE_MERCHANT_ID');
        $saltKey = env('PHONEPE_SALT_KEY');
        $saltIndex = env('PHONEPE_SALT_INDEX');
        $baseUrl = env('PHONEPE_BASE_URL');

        $checksum = hash('sha256', "/pg/v1/status/$merchantId/$transactionId" . $saltKey) . "###" . $saltIndex;

        $statusResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $checksum,
        ])->get("$baseUrl/pg/v1/status/$merchantId/$transactionId");

        if (!$statusResponse->successful()) {
            return response()->json(['message' => 'Unable to get payment status'], 500);
        }

        $data = $statusResponse['data'];
        $orderStatus = $data['responseCode'] ?? $data['state'];

        $payment->update([
            'status' => $orderStatus,
            'response_payload' => json_encode($data),
        ]);

        if ($orderStatus === 'SUCCESS' || $data['state'] === 'COMPLETED') {
            // Use DB transaction to ensure data consistency
            DB::beginTransaction();

            try {
                $orderData = $payment->payload ? json_decode($payment->payload, true) : [];

                $order = Order::create(array_merge($orderData, [
                    'user_id' => $payment->user_id,
                    'status' => 'Pending',
                    'payment_status' => 'Paid'
                ]));

                $payment->update([
                    'order_id' => $order->id,
                ]);

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

                DB::commit();

                SendOrderConfirmationJob::dispatch($order);

                return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Order creation failed: ' . $e->getMessage());
                return redirect()->route('checkout')->with('error', 'Order processing failed. Please contact support.');
            }
        } else {
            return redirect()->route('checkout')->with('error', 'Payment failed.');
        }
    }
}
