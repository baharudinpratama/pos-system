<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Start
Route::get('/', fn () => redirect()->route('login'));

Auth::routes();

Route::group(['middleware' => ['role:admin|cashier']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pos
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::post('/pos/order/store', [PosController::class, 'storeOrder']);
    Route::post('/pos/order/confirm-order', [PosController::class, 'confirmOrder']);
    Route::delete('/pos/order/{id}', [PosController::class, 'deleteOrder']);
    Route::get('/transactions', [PosController::class, 'transaction']);
});

Route::group(['middleware' => ['role:admin']], function () {

    // Product
    Route::resource('/products', ProductController::class);
    Route::get('api/products', [ProductController::class, 'api']);

    // Category
    Route::resource('/categories', CategoryController::class);
    Route::get('api/categories', [CategoryController::class, 'api']);

    // Report
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Roles
    Route::get('/roles', [UserController::class, 'addRole']);
});