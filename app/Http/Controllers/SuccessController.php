<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;
use App\Models\Shoppingcart;

class SuccessController extends Controller
{
    function index(Request $request, $id){
        $order = Order::find($id);
        $paymentId = $order->mollie_id;

        $payment = Mollie::api()->payments->get($paymentId);

        if($payment->isPaid()){
            Shoppingcart::where('cart_number', 0)->update(['cart_number' => 1]);
            return redirect(env('ASTRO_URL') . "?status=betaald");
        } else {
            return redirect(env('ASTRO_URL') ."?status=mislukt");
        }
    }
}
