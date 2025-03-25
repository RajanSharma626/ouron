<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::paginate(20);
        return view('admin.customers', compact('customers'));
    }
}
