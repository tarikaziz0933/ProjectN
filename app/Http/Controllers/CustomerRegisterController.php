<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerRegisterController extends Controller
{
    function register_login()
    {
        return view('frontend.customer_register');
    }
    function register_store(Request $request)
    {
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}