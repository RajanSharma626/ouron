<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        return view('admin.products');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function users()
    {
        return view('admin.users');
    }
}
