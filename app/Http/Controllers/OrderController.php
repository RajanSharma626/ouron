<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderEmailJob;
use App\Jobs\SendOrderSmsJob;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['items.product.firstimage', 'user'])
            ->latest()
            ->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::with(['items', 'user'])->findOrFail($id);

        $statusHistory = OrderStatusHistory::with('changedBy') // assuming relation for changed_by
                        ->where('order_id', $id)
                        ->orderBy('changed_at', 'desc')
                        ->get();

        return view('admin.order-detail', compact('order', 'statusHistory'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->where('id', $id)->with('items.product', 'address')->firstOrFail();
        return view('frontend.orders-detail-history', compact('order'));
    }

    public function confirm(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Confirmed']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'confirmed',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as confirmed successfully.');
    }

    public function packed(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Packed']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'packed',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Packed');

        // Dispatch SMS
        $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been carefully packed and is ready for shipment. Thank you for shopping with us!";
        SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as packed successfully.');
    }

    public function shipped(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Shipped']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'shipped',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Shipped');

        // Dispatch SMS
        $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been shipped and is on its way. Thank you for shopping with us!";
        SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as shipped successfully.');
    }

    public function delivered(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Delivered']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'delivered',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Delivered');

        // Dispatch SMS
        $smsMessage = "Dear {$order->first_name}, we are pleased to inform you that your order #{$order->id} has been successfully delivered. Thank you for choosing us!";
        SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as delivered successfully.');
    }

    
}
