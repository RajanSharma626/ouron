<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::with('defaultAddress')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.customers', compact('customers'));
    }

    public function downloadCSV()
    {
        $customers = User::with('defaultAddress')->get();

        $csvFileName = 'customers.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Address']);

        foreach ($customers as $customer) {
            fputcsv($handle, [
                $customer->id,
                $customer->name,
                $customer->email,
                $customer->phone,
                optional($customer->defaultAddress)->address,
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
