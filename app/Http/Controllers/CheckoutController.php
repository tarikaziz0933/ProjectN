<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceSend;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function checkout()
    {
        if (Auth::guard('customerlogin')->check()) {
            $countries = Country::all();
            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
            $cart_total = 0;
            foreach ($carts as $cart) {
                $cart_total += $cart->rel_to_product->after_discount * $cart->quantity;
            }
            return view('frontend.checkout', [
                'sub_total' => $cart_total,
                'countries' => $countries,
            ]);
        } else {
            return redirect()->route('customer.register.login')->with('login', 'Please login to add cart');
        }
    }

    function getCity(Request $request)
    {
        $str = '<option value="">Select City</option>';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $str .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $str;
    }

    function order_store(Request $request)
    {
        if ($request->payment_method == 1) {
            $order_id = Order::insertGetId([
                'user_id' => Auth::guard('customerlogin')->id(),
                'subtotal' => $request->sub_total,
                'discount' => $request->discount,
                'charge' => $request->cgarge,
                'total' => $request->total,
                'created_at' => Carbon::now(),
            ]);

            BillingDetails::insert([
                'order_id' => $order_id,
                'user_id' => Auth::guard('customerlogin')->id(),
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'note' => $request->note,
                'created_at' => Carbon::now(),
            ]);

            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'user_id' => Auth::guard('customerlogin')->id(),
                    'order_id' => $order_id,
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'price' => $cart->rel_to_product->after_discount,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);

                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }

            //SMS Send
            $url = "http://bulksmsbd.net/api/smsapi";
            $api_key = "ZP52xEry2LNqdQCYPZNH";
            $senderid = "8809617";
            $number = $request->phone;
            $message = "Thank you for Purchasing our product, Your total amount is:" . $request->total;

            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            //Dt123456@
            //Invoice send by email
            Mail::to($request->email)->send(new InvoiceSend($order_id));

            // return view('invoice.invoice');

            // Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();

            return redirect()->route('order.success')->with('success', $request->name);
        } elseif ($request->payment_method == 2) {
            echo 'ssl';
        } else {
            echo 'Stripe Payment';
        }
    }

    function order_success()
    {
        return view('layouts.order_success');
    }
}