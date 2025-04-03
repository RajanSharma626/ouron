<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
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
        return view('admin.order-detail', compact('order'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->where('id', $id)->with('items.product', 'address')->firstOrFail();
        return view('frontend.orders-detail-history', compact('order'));
    }
}
