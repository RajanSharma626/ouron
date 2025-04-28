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
        $order = Order::with(['items', 'user', 'payment'])->findOrFail($id);

        $statusHistory = OrderStatusHistory::with('changedBy') // assuming relation for changed_by
            ->where('order_id', $id)
            ->orderBy('changed_at', 'desc')
            ->get();

        return view('admin.order-detail', compact('order', 'statusHistory'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->where('id', $id)->with('items.product', 'address', 'payment')->firstOrFail();
        return view('frontend.orders-detail-history', compact('order'));
    }

    public function confirm(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Cancelled') {
            return redirect()->route('admin.order.view', $id)->withErrors(['error' => 'Order is already cancelled and cannot be confirmed.']);
        }

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

    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check if the order is not already confirmed
        if ($order->status === 'Confirmed') {
            return redirect()->route('orders.show', $id)->withErrors(['error' => 'Order cannot be cancelled as it is already Prepared.']);
        }

        $order->update(['status' => 'Cancelled']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Cancelled',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Cancelled');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been cancelled. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('orders.show', $id)->with('success', 'Order cancelled successfully.');
    }

    public function AdminCancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check if the order is not already confirmed
        if ($order->status === 'Cancel' || $order->status === 'Confirmed') {
            return redirect()->route('orders.show', $id)->withErrors(['error' => 'Order cannot be Confirmed/Cancel as it is already Prepared.']);
        }


        $order->update(['status' => 'Cancelled']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Cancelled',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Cancelled');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been cancelled. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order cancelled successfully.');
    }

    public function returnRequest(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check if the order is within the 7-day return period
        $orderDate = $order->created_at;
        $currentDate = now();
        if ($orderDate->diffInDays($currentDate) > 7) {
            return redirect()->route('orders.show', $id)->withErrors(['error' => 'Return request cannot be submitted as the order exceeds the 7-day return period.']);
        }

        $order->update(['status' => 'Return Requested']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Return Requested',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Return Requested');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your return request for order #{$order->id} has been received. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('orders.show', $id)->with('success', 'Return request submitted successfully.');
    }

    public function returnedApprove(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Return Approved']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Return Approved',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Return Approved');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your return request for order #{$order->id} has been approved. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Return request approved successfully.');
    }

    public function returnedCancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Returned Cancelled']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Returned Cancelled',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Returned Cancelled');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your return request for order #{$order->id} has been cancelled. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Return request cancelled successfully.');
    }


    public function return(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Returned']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Returned',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Returned');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been returned. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as returned successfully.');
    }

    public function refund(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Refunded']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Refunded',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Refunded');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been refunded. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as refunded successfully.');
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
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been carefully packed and is ready for shipment. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

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
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} has been shipped and is on its way. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as shipped successfully.');
    }

    public function outForDelivery(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Out for Delivery']);

        // Store history
        $order->statusHistories()->create([
            'status' => 'out_for_delivery',
            'comment' => $request->input('comment', null),
            'changed_by' => Auth::id(),
        ]);

        // Dispatch Email Job
        SendOrderEmailJob::dispatch($order, 'Out for Delivery');

        // Dispatch SMS
        // $smsMessage = "Dear {$order->first_name}, your order #{$order->id} is out for delivery. Thank you for shopping with us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as out for delivery successfully.');
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
        // $smsMessage = "Dear {$order->first_name}, we are pleased to inform you that your order #{$order->id} has been successfully delivered. Thank you for choosing us!";
        // SendOrderSmsJob::dispatch($order->phone, $smsMessage);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as delivered successfully.');
    }

    public function downloadCSV()
    {
        $orders = Order::with(['items.product.firstimage', 'user'])->get();

        $csvFileName = 'orders.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['ID', 'User', 'Product', 'Size', 'Email', 'Phone', 'Address', 'Total Amount', 'Payment Method', 'Quantity', 'Status', 'Created At']);

        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->id,
                optional($order->user)->name,
                $order->items->pluck('product.name')->filter()->implode(', '),
                $order->items->pluck('size')->filter()->implode(', '),
                $order->email,
                $order->phone,
                $order->address . " " . $order->address2 . " " . $order->city . ", " . $order->state . ", " . $order->pin_code,
                $order->items->sum('price'), // Assuming you want the total price of all items
                $order->payment_method,
                $order->items->sum('quantity'), // Assuming you want the total quantity of all items
                $order->status,
                $order->created_at,
            ]);
        }

        rewind($handle);

        return response()->stream(
            function () use ($handle) {
                fpassthru($handle);
            },
            200,
            $headers
        );
    }
}
