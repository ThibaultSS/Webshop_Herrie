<?php

use Illuminate\Support\Facades\Route;

Route::get('astro/get/products', [\App\Http\Controllers\ProductController::class, 'getProducts']);
Route::get('astro/get/products/{id}', [\App\Http\Controllers\ProductController::class, 'getProductById']);

Route::post('api/order', [\App\Http\Controllers\OrderController::class, 'insertOrder']);