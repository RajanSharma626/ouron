<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::paginate(15);
        return view('admin.coupon', compact('coupons'));
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function create()
    {
        return view('admin.create-coupon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupons-code'   => 'required|string|unique:coupons,coupon_code',
            'coupons-limits' => 'required|integer|min:1',
            'discount-value' => 'required|numeric|min:0',
            'coupons-type'   => 'required|in:free_shipping,percentage,fixed_amount',
            'start-date'     => 'required|date',
            'end-date'       => 'required|date|after_or_equal:start-date',
        ]);

        Coupon::create([
            'coupon_code'   => $request->input('coupons-code'),
            'coupon_limits' => $request->input('coupons-limits'),
            'discount_value' => $request->input('discount-value'),
            'coupon_type'   => $request->input('coupons-type'),
            'start_date'    => $request->input('start-date'),
            'end_date'      => $request->input('end-date'),
        ]);

        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully!');
    }


    public function update(Request $request)
    {
        $coupon = Coupon::findOrFail($request->input('coupons-id'));
        $coupon->update([
            'coupon_code'   => $request->input('coupons-code'),
            'coupon_limits' => $request->input('coupons-limits'),
            'discount_value' => $request->input('discount-value'),
            'coupon_type'   => $request->input('coupons-type'),
            'start_date'    => $request->input('start-date'),
            'end_date'      => $request->input('end-date'),
        ]);

        return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully.');
    }
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully.');
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon-detail', compact('coupon'));
    }


    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}
