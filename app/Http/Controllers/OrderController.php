<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderEmailJob;
use App\Jobs\SendOrderSmsJob;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use TCPDF;

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
        $order = Order::with(['items', 'user', 'payment', 'invoice'])->findOrFail($id);

        $statusHistory = OrderStatusHistory::with('changedBy') // assuming relation for changed_by
            ->where('order_id', $id)
            ->orderBy('changed_at', 'desc')
            ->get();

        return view('admin.order-detail', compact('order', 'statusHistory'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->where('id', $id)->with('items.product', 'address', 'payment', 'invoice')->firstOrFail();
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

        // Generate invoice after confirmation
        $this->generateInvoice($order);

        // ✅ History for invoice generation
        $order->statusHistories()->create([
            'status' => 'invoice_generated',
            'comment' => 'Invoice has been generated.',
            'changed_by' => Auth::id(),
        ]);

        // ✅ Create order in Shiprocket
        $this->createShiprocketOrder($order);

        return redirect()->route('admin.order.view', $id)->with('success', 'Order marked as confirmed successfully.');
    }

    public function generateInvoice($order)
    {
        $invoiceNumber = 'INV' . str_pad($order->id, 8, '0', STR_PAD_LEFT);
        $items = OrderItem::with('product')->where('order_id', $order->id)->get();

        // Initialize mPDF
        $mpdf = new Mpdf();

        // Load the view and render HTML content
        $pdfContent = view('admin.invoice', compact('order', 'invoiceNumber', 'items'))->render();

        // Write HTML to PDF
        $mpdf->WriteHTML($pdfContent);

        // Output the PDF
        $fileName = 'invoice_' . $order->id . '.pdf';
        $filePath = public_path('invoices/' . $fileName);

        // Ensure the invoices folder exists
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0777, true);
        }

        // Save the PDF to file
        $mpdf->Output($filePath, 'F');

        // Store invoice details in the database
        $invoice = new Invoice();
        $invoice->invoice_number = $invoiceNumber;
        $invoice->user_id = $order->user_id;
        $invoice->order_id = $order->id;
        $invoice->invoice_path = 'invoices/' . $fileName;
        $invoice->save();
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

        $request->validate([
            'reason' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $order = Order::findOrFail($id);

        // Check if the order is within the 7-day return period
        $orderDate = $order->created_at;
        $currentDate = now();
        if ($orderDate->diffInDays($currentDate) > 7) {
            return redirect()->route('orders.show', $id)->withErrors(['error' => 'Return request cannot be submitted as the order exceeds the 7-day return period.']);
        }

        $order->update(['status' => 'Return Requested', 'return_reason' => $request->input('reason', null)]);

        // Store history
        $order->statusHistories()->create([
            'status' => 'Return Requested',
            'comment' => $request->input('reason', null), // Save the return reason
            'changed_by' => Auth::id(),
        ]);

        // Handle uploaded images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) { // Ensure the file is valid
                    $path = $image->store('upload/returns', 'public'); // Save images in the 'upload/returns' directory
                    $imagePaths[] = $path;
                }
            }
            if (!empty($imagePaths)) {
                $order->update(['return_image' => json_encode($imagePaths)]); // Store all image paths as a JSON array in the return_images column
            }
        }

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

    private function createShiprocketOrder($order)
    {
        $token = $this->getShiprocketToken();

        // Prepare the order items and calculate total weight
        $items = [];
        $totalWeight = 0;

        foreach ($order->items as $item) {
            $product = $item->product;
            $items[] = [
                'name' => $item->product->name,
                'sku' => 'SKU_' . $item->product_id,
                'units' => $item->quantity,
                'selling_price' => $item->price,
            ];

            // Accumulate total weight
            $totalWeight += (is_numeric($product->weight) ? (float)$product->weight : 0.5) * $item->quantity;
        }

        // Payload for Shiprocket API request
        $payload = [
            'order_id' => $order->id,
            'order_date' => $order->created_at->format('Y-m-d'),
            'pickup_location' => 'work',  // Ensure this location is defined in Shiprocket settings
            'billing_customer_name' => $order->first_name,
            'billing_last_name' => $order->last_name ?? '', // Fallback if last_name is missing
            'billing_address' => $order->address,
            'billing_address_2' => $order->address2 ?? '',
            'billing_city' => $order->city,
            'billing_pincode' => $order->pin_code,
            'billing_state' => $order->state,
            'billing_country' => 'India',
            'billing_email' => $order->email,
            'billing_phone' => $order->phone,
            'shipping_is_billing' => true,  // Use the same billing address for shipping
            'order_items' => $items,
            'payment_method' => $order->payment_method === 'COD' ? 'COD' : 'Prepaid',
            'sub_total' => $order->subtotal,
            'length' => 10,
            'breadth' => 10,
            'height' => 5,
            'weight' => $totalWeight,
        ];

        // Log the payload for debugging purposes
        Log::info('Shiprocket Order Payload:', ['payload' => $payload]);

        // Make the API call to Shiprocket
        $response = Http::withToken($token)->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', $payload);

        // Decode the response
        $data = $response->json();

        if (isset($data['order_id'])) {
            // Save the Shiprocket order ID to the order table
            $order->update(['shiprocket_order_id' => $data['order_id']]);
        } else {
            // Log error if the API call fails
            Log::error('Shiprocket order creation failed', ['response' => $data]);
        }
    }
}
