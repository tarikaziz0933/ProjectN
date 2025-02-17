<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function add_coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', [
            'coupons' => $coupons,
        ]);
    }
    function coupon_store(Request $request)
    {
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'min' => $request->min,
            'max' => $request->max,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function coupon_status($coupon_id)
    {
        $coupon_ids = Coupon::all();
        foreach ($coupon_ids as $cid) {
            // echo $cid->id;
            // die();
            if ($coupon_id == $cid->id) {
                $cid->update([
                    'status' => 1,
                ]);
            } else {
                $cid->update([
                    'status' => 0,
                ]);
            }
        }
        return back();
    }
}