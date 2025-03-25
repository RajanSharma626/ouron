<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon', compact('coupons'));
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
            'status'         => 'required|in:active,inactive,future',
            'start-date'     => 'required|date',
            'end-date'       => 'required|date|after_or_equal:start-date',
        ]);

        Coupon::create([
            'coupon_code'   => $request->input('coupons-code'),
            'coupon_limits' => $request->input('coupons-limits'),
            'discount_value'=> $request->input('discount-value'),
            'coupon_type'   => $request->input('coupons-type'),
            'status'        => $request->status,
            'start_date'    => $request->input('start-date'),
            'end_date'      => $request->input('end-date'),
        ]);

        return redirect()->route('admin.couponS')->with('success', 'Coupon created successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.edit-coupon', compact('coupon'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string',
            'discount' => 'required|numeric',
            'discount_type' => 'required|string|in:fixed,percentage',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer'
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

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


    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code.');
        }

        if (!$coupon->isValid()) {
            return back()->with('error', 'Coupon expired or usage limit reached.');
        }

        // Store coupon details in session
        Session::put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->discount,
            'discount_type' => $coupon->discount_type
        ]);

        return back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}
