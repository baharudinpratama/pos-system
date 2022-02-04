<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Start
Route::get('/', fn () => redirect()->route('login'));

Auth::routes();

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Product
Route::resource('/products', ProductController::class);
Route::get('api/products', [ProductController::class, 'api']);

// Category
Route::resource('/categories', CategoryController::class);
Route::get('api/categories', [CategoryController::class, 'api']);

// Pos
Route::get('/pos', [PosController::class, 'index'])->name('pos');
Route::post('/pos/order/store', [PosController::class, 'storeOrder']);
Route::post('/pos/order/confirm-order', [PosController::class, 'confirmOrder']);
Route::delete('/pos/order/{id}', [PosController::class, 'deleteOrder']);
