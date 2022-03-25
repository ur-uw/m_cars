<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\Order;
use Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        return view('checkout', compact('user'));
    }

    public function charge(CheckoutRequest $request)
    {

        try {
            $contents = Cart::content()->map(function ($item) {
                return $item->name . ', ' . $item->qty;
            })->values()->toJson();
            $charge = Stripe::charges()->create([
                'amount' => Cart::total() * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test Charge',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::count(),
                ],
            ]);
            $order =  $this->insertIntoOrdersTable($request, null);
            Mail::send(new OrderPlaced($order));
            // SUCCESSFUL
            Cart::destroy();
            return redirect()->route('explore.show');
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            $this->insertIntoOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Save order data to database
     *
     * @param  \App\Http\Requests\CheckoutRequest $request
     * @param string|null $error
     **/
    protected function insertIntoOrdersTable($request, $error): Order|null
    {
        $order = null;
        DB::transaction(function () use ($request, $error, &$order) {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'billing_email' => $request->email,
                'billing_name' => $request->name,
                'billing_address' => $request->address,
                'billing_city' => $request->city,
                'billing_province' => $request->state,
                'billing_postalcode' => $request->postal_code,
                'billing_phone' => $request->phone,
                'billing_name_on_card' => $request->name_on_card,
                'error' => $error,
                'billing_discount' => 0,
                'billing_subtotal' => Cart::subtotal() * 100,
                'billing_tax' => Cart::tax() * 100,
                'billing_total' => Cart::total() * 100,
            ]);

            // Insert into order_product table
            foreach (Cart::content() as $item) {
                $order->products()->attach(
                    $item->id,
                    [
                        'quantity' => $item->qty,
                    ],
                );
            }
        });
        return $order;
    }
}
