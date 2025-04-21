<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function phonepeCallback(Request $request)
    {
        $transactionId = $request->input('transactionId');
        if (!$transactionId) {
            return response()->json(['message' => 'Missing transaction ID'], 400);
        }

        $payment = Payment::where('transaction_id', $transactionId)->first();
        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
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

        $status = $data['responseCode'] ?? $data['state'];
        $payment->update([
            'status' => $status,
            'response_payload' => json_encode($data),
        ]);

        $order = $payment->order;

        if ($status === 'SUCCESS' || $data['state'] === 'COMPLETED') {
            $order->update(['payment_status' => 'Paid']);
        } elseif ($status === 'FAILED' || $data['state'] === 'FAILED') {
            $order->update(['payment_status' => 'Failed']);
        }

        return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully');
    }
}
