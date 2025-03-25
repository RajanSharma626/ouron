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
        return view('admin.dashboard', compact('TotalOrders', 'TotalUsers', 'TotalProducts', 'TotalOrdersAmount'));
    }
}
