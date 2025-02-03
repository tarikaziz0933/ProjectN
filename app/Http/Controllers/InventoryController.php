<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function inventory($product_id)
    {
        $product_info = Product::find($product_id);
        return view('admin.product.inventory', [
            'product_info' => $product_info,
        ]);
    }

    function variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.add_variation', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    function add_color(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function add_size(Request $request)
    {
        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
