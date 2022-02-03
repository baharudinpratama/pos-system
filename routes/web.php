<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => redirect()->route('login'));

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('/products', App\Http\Controllers\ProductController::class);
Route::get('api/products', [App\Http\Controllers\ProductController::class, 'api']);

Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::get('api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
