<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
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

Auth::routes();
Route::get('/', [FrontendController::class, 'welcome']);
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