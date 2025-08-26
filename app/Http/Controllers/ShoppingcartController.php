<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Shoppingcart;

class ShoppingcartController extends Controller
{
    function getShoppingcartItems()
    {
        $shoppingcartItems = Shoppingcart::where('cart_number', 0)->get();
        foreach ($shoppingcartItems as $item) {
            $product = Product::find($item->product_id);
            $item->product = $product;
            if ($product) {
                $images = Image::where('product_id', $product->id)->get();
                $product->images = $images;
            } else {
                $item->product = null;
            }
        }
        return response()->json($shoppingcartItems);
    }
}
