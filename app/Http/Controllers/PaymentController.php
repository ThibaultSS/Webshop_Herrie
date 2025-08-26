<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;
use App\Models\Shoppingcart;


class PaymentController extends Controller
{

    public function preparePayment()
{
    $total = \DB::table('shoppingcarts')
    ->join('products', 'shoppingcarts.product_id', '=', 'products.id')
    ->selectRaw('SUM(shoppingcarts.amount * products.price) as total')
    ->value('total');
    
    $ordersForIntel = Shoppingcart::all()
    ->map(function ($cart) {
        return [
            'product_id' => $cart->product_id,
            'amount'     => $cart->amount,
        ];
    })
    ->toArray();

    $order = new Order();
    $totalPrice = (float)$total;
    $order->customer_name = "Test Customer";
    $order->price = $totalPrice;
    $order->mollie_id = null; // Initially set to null, will be updated after payment creation
    $order->save();

    $payment = Mollie::api()->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => number_format($totalPrice, 2), // You must send the correct number of decimals, thus we enforce the use of strings
        ],
        "description" => "#12345",
        "redirectUrl" => route('order.success',['id' => $order->id]),
        //"webhookUrl" => route('webhooks.mollie'),
        "metadata" => [
            "id" => $order->id,
            "customer_name" => "Test Customer",
            "orders" => $ordersForIntel,
            "price" => $totalPrice,
        ],
    ]);
    $order->customer_name = "Test Customer";
    $order->mollie_id = $payment->id;
    $order->price = $totalPrice;
    $order->save();

    // redirect customer to Mollie checkout page
    return redirect($payment->getCheckoutUrl(), 303);
}


}
