<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout()
    {
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        $cart_total = 0;
        foreach ($carts as $cart) {
            $cart_total += $cart->rel_to_product->after_discount * $cart->quantity;
        }
        return view('frontend.checkout', [
            'sub_total' => $cart_total,
        ]);
    }
}