<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
        return view('checkout', [
            'basket' => auth()->user()->basket
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        $paymentMethodID = $request->input('paymentMethodID');

        try {
            if($user->stripe_id == null) {
                $user->createAsStripeCustomer();
            }

            $user->addPaymentMethod($paymentMethodID);

            $payment = $user->charge($user->getBasketTotal() * 100, $paymentMethodID); // convert 7.99 * 100

            //Save order
            $order = Order::create([
                'status' => 'Pending',
                'transaction_id' => $payment->id,
                'user_id' => $user->id,
            ]);

            //Save order details
            foreach($user->basket as $basket) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $basket->product->id,
                    'qty' => $basket->qty,
                    'price' => $basket->price,
                ]);
            }

            return view('order-confirmation', [
                'message' => 'Thank you for your order',
                'order_id' => $order->id,
                'transaction_id' => $order->id,
            ]);
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
}
