<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collections;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::with('category', 'collection', 'product')->paginate(15);
        return view('admin.coupon', compact('coupons'));
    }

    public function edit($id)
    {

        $categories = Category::all();
        $collections = Collections::all();
        $products = Product::whereNull('deleted_at')->get();

        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon-edit', compact('coupon', 'categories', 'collections', 'products'));
    }

    public function create()
    {
        return view('admin.create-coupon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupons-code'   => 'required|string|unique:coupons,coupon_code',
            'discount-value' => 'required|numeric|min:0',
            'coupons-type'   => 'required|in:free_shipping,percentage,fixed_amount',
            'start-date'     => 'required|date',
            'end-date'       => 'required|date|after_or_equal:start-date',
            'for-type'       => 'required|in:all,category,collection,product',
        ]);

        $couponData = [
            'coupon_code'   => $request->input('coupons-code'),
            'discount_value' => $request->input('discount-value'),
            'coupon_type'   => $request->input('coupons-type'),
            'start_date'    => $request->input('start-date'),
            'end_date'      => $request->input('end-date'),
            'for_type'      => $request->input('for-type'),
            'category_id' => $request->input('category'),
            'collection_id' => $request->input('collection'),
            'product_id' => $request->input('product'),
        ];

        Coupon::create($couponData);

        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully!');
    }


    public function update(Request $request)
    {
        $request->validate([
            'coupons-id'     => 'required|exists:coupons,id',
            'coupons-code'   => 'required|string|unique:coupons,coupon_code,' . $request->input('coupons-id'),
            'discount-value' => 'required|numeric|min:0',
            'coupons-type'   => 'required|in:free_shipping,percentage,fixed_amount',
            'start-date'     => 'required|date',
            'end-date'       => 'required|date|after_or_equal:start-date',
            'for-type'       => 'required|in:all,category,collection,product',
        ]);

        $coupon = Coupon::findOrFail($request->input('coupons-id'));

        $couponData = [
            'coupon_code'   => $request->input('coupons-code'),
            'discount_value' => $request->input('discount-value'),
            'coupon_type'   => $request->input('coupons-type'),
            'start_date'    => $request->input('start-date'),
            'end_date'      => $request->input('end-date'),
            'for_type'      => $request->input('for-type'),
            'category_id'   => $request->input('category'),
            'collection_id' => $request->input('collection'),
            'product_id'    => $request->input('product'),
        ];

        $coupon->update($couponData);

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
