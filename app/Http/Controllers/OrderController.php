<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoppingcart;

class OrderController extends Controller
{
    public function insertOrder(Request $request)
    {
        $productId = $request->query('product_id');
        $cartNumber = $request->query('cart_number');
        $amount = $request->query('amount');

        $existing = Shoppingcart::where('product_id', $productId)
                    ->where('cart_number', $cartNumber)
                    ->first();

        if ($existing) {
            $existing->amount += $amount;
            $existing->save();
            
        } else {
            Shoppingcart::create([
                'product_id' => $productId,
                'amount' => $amount,
                'cart_number' => $cartNumber,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
    public function deleteOrder(Request $request)
    {
        $productId = $request->query('product_id');
        Shoppingcart::where('product_id', $productId)->delete();
        return response()->json(['status' => 'ok']);
    }
    
}