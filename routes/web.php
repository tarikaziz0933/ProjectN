<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Auth::routes();
Route::get('/', [FrontendController::class, 'welcome'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');

//Backend
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/delete/user/{user_id}', [HomeController::class, 'delete'])->name('delete.user');

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/edit/category/{category_id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/update/category', [CategoryController::class, 'update'])->name('category.update');
Route::get('/delete/category/{category_id}', [CategoryController::class, 'delete'])->name('delete.category');
Route::post('/delete/mark/delete', [CategoryController::class, 'mark_delete'])->name('category.marked');
Route::get('/restore/category/{category_id}', [CategoryController::class, 'restore'])->name('restore.category');
Route::get('/permament/delete/category/{category_id}', [CategoryController::class, 'perDelete'])->name('permanent.delete.category');


//Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
Route::post('/subcategory/store', [SubcategoryController::class, 'subCategoryStore'])->name('subcategory.store');

//Product
Route::get('/product', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');

//Inventory
Route::get('/product/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::get('/product/variation', [InventoryController::class, 'variation'])->name('variation');
Route::post('/add/color', [InventoryController::class, 'add_color'])->name('add.color');
Route::post('/add/size', [InventoryController::class, 'add_size'])->name('add.size');
Route::post('/add/inventory', [InventoryController::class, 'add_inventory'])->name('add.inventory');

Route::post('/getSize', [FrontendController::class, 'getSize']);