<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    function account()
    {

        return view('layouts.account');
    }
}