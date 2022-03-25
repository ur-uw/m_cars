<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;
use Livewire\Component;

class CartView extends Component
{
    public $products;
    public $cart;

    protected $listeners = ['cart_updated' => 'updateCartContent'];

    public function updateCartContent()
    {
        $this->cart = CartFacade::content();
        $this->updateCartProducts();
    }

    protected function updateCartProducts()
    {
        $productInCartIds = [];
        foreach ($this->cart as $item) {
            $productInCartIds[] = $item->id;
        }
        $this->products = Product::whereIn('id', $productInCartIds)->get();
    }

    public function mount()
    {
        $this->cart = CartFacade::content();
        $this->updateCartProducts();
    }

    public function render()
    {
        return view(
            'livewire.cart.cart-view',
        )->extends('layouts.app');
    }
}
