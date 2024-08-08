<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('dashboard.coupons.create');
    }

    public function store(CouponRequest $request)
    {

        Coupon::create($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
    }

    public function edit(Coupon $coupon)
    {

        return view('dashboard.coupons.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy(Request $request)
    {
        $Coupon = Coupon::findorFail($request->id);
        $Coupon->delete();
        return response()->json();
    }

    public function changeStatus(Request $request)
    {
        $Coupon = Coupon::findorFail($request->id);
        $Coupon->update([
            'is_active' => ! $Coupon->is_active
        ]);

        return response()->json();
    }

}
