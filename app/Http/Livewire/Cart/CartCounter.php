<?php

namespace App\Http\Livewire\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        $cart_count = Cart::content()->count();

        return view('livewire.cart.cart-counter', compact('cart_count'));
    }
}
