<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    function getProducts()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $images = Image::where('product_id', $product->id)->get();
            $product->images = $images;
        }
        return response()->json($products);
    }
}
