<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;

class SuccessController extends Controller
{
    function index(Request $request, $id){
        $order = Order::find($id);
        $paymentId = $order->mollie_id;

        $payment = Mollie::api()->payments->get($paymentId);

        if($payment->isPaid()){
            return redirect("http://localhost:4321/?status=betaald");
        } else {
            return redirect("http://localhost:4321/?status=mislukt");
        }
    }
}
