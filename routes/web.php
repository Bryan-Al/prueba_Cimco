<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupplierController;



Route::get('/', function () {
    return redirect()->route('products.index');
});

// Resto de tus rutas...

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('suppliers', SupplierController::class);
});


