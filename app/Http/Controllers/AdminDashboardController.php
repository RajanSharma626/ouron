<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $TotalOrders = Order::count();
        $TotalUsers = User::count();
        $TotalProducts = Product::count();
        $TotalOrdersAmount = Order::sum('total');

        $orders = Order::with(['items.product.firstimage', 'user'])
            ->where('status', '!=', 'Canceled')
            ->where('status', '!=', 'Refunded')
            ->where('status', '!=', 'Failed')
            ->where('status', '!=', 'Returned')
            ->where('status', '!=', 'Shipped')
            ->where('status', '!=', 'Delivered')
            ->where('status', '!=', 'Completed')
            ->latest()
            ->paginate(15);


        return view('admin.dashboard', compact('TotalOrders', 'TotalUsers', 'TotalProducts', 'TotalOrdersAmount', 'orders'));
    }
}
