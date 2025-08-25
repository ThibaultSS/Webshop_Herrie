<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoppingcart;

class OrderController extends Controller
{
    public function insertOrder(Request $request)
    {
        $cart = Shoppingcart::create([
            'product_id' => $request->input('product_id'),
            'amount' => $request->input('amount'),
            'cart_number' => $request->input('cart_number'),
        ]);

        return response()->json($cart);
    }
}