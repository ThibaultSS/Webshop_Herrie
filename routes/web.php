<?php

use Illuminate\Support\Facades\Route;

Route::get('astro/get/products', [\App\Http\Controllers\ProductController::class, 'getProducts']);
Route::get('astro/get/products/{id}', [\App\Http\Controllers\ProductController::class, 'getProductById']);

Route::get('api/order', [\App\Http\Controllers\OrderController::class, 'insertOrder']);
Route::get('astro/get/shoppingcart', [\App\Http\Controllers\ShoppingcartController::class, 'getShoppingcartItems']);
Route::get('api/delete/order', [\App\Http\Controllers\OrderController::class, 'deleteOrder']);

Route::get('/order', [\App\Http\Controllers\PaymentController::class, 'preparePayment']);
Route::get('/order/success/{id}', [\App\Http\Controllers\SuccessController::class, 'index'])->name('order.success');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'submit']);