<?php

use Illuminate\Support\Facades\Route;

Route::get('astro/get/products', [\App\Http\Controllers\ProductController::class, 'getProducts']);