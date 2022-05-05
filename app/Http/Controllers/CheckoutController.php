<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\Car;
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
    public function carCheckout(Car $car)
    {
        $user = Auth::user();
        $car_image = session('car_image');

        return view('car-checkout', compact('user', 'car', 'car_image'));
    }

    public function chargeProducts(CheckoutRequest $request)
    {

        try {
            $contents = Cart::content()->map(function ($item) {
                return $item->name . ', ' . $item->qty;
            })->values()->toJson();
            Stripe::charges()->create([
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
            $order =  $this->insertIntoOrdersTable(
                $request,
                null,
                Cart::subtotal() * 100,
                Cart::tax() * 100,
                Cart::total() * 100,
                Cart::content()
            );
            Mail::send(new OrderPlaced($order));
            // SUCCESSFUL
            Cart::destroy();
            return redirect()->route('explore.show')
                ->withSuccess('Successfully purchased products!');
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            toast($e->getMessage(), 'error');
            $this->insertIntoOrdersTable(
                $request,
                $e->getMessage(),
                Cart::subtotal() * 100,
                Cart::tax() * 100,
                Cart::total() * 100,
                Cart::content()
            );
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
    public function chargeCar(CheckoutRequest $request, Car $car)
    {
        try {
            $carPrice =  (float)str_replace(',', '', $car->details->price);
            Stripe::charges()->create([
                'amount' => $carPrice,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Car Charge',
                'receipt_email' => $request->email,
            ]);
            session()->forget('car_image');
            Auth::user()->cars()->save($car);

            return redirect()->route('explore.show')
                ->withSuccess('Successfully purchased car!');
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            toast($e->getMessage(), 'error');
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Save order data to database
     *
     * @param  \App\Http\Requests\CheckoutRequest $request
     * @param string|null $error
     **/
    protected function insertIntoOrdersTable($request, $error, $subtotal, $tax, $billing_total, $items): Order|null
    {
        $order = null;
        DB::transaction(function () use ($request, $error, &$order, &$items, &$subtotal, &$tax, &$billing_total) {
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
                'billing_subtotal' => $subtotal,
                'billing_tax' => $tax,
                'billing_total' => $billing_total,
            ]);

            // Insert into order_product table
            foreach ($items as $item) {
                $order->products()->attach(
                    $item->id,
                    [
                        'quantity' => $item->qty ?? 1,
                    ],
                );
            }
        });
        return $order;
    }
}
