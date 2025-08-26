<?php

use Illuminate\Support\Facades\Route;

Route::get('astro/get/products', [\App\Http\Controllers\ProductController::class, 'getProducts']);
Route::get('astro/get/products/{id}', [\App\Http\Controllers\ProductController::class, 'getProductById']);

Route::get('api/order', [\App\Http\Controllers\OrderController::class, 'insertOrder']);
Route::get('astro/get/shoppingcart', [\App\Http\Controllers\ShoppingcartController::class, 'getShoppingcartItems']);
Route::get('api/delete/order', [\App\Http\Controllers\OrderController::class, 'deleteOrder']);
