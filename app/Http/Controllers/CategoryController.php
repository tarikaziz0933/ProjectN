<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::all();
        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }
    function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
        ], [
            'category_name.required' => 'Please enter the name',
            'category_name.unique' => 'Category already exist',
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category added sucessfully');
    }
    function edit($category_id)
    {
        $category_info = Category::find($category_id);
        return view('admin.category.edit', [
            'category_info' => $category_info,
        ]);
    }
    function update(Request $request)
    {
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect('/category')->with('success', 'Category updated sucessfully');
    }
    function delete($category_id)
    {
        // echo $category_id;
        Category::find($category_id)->delete();
        return back();
    }
}