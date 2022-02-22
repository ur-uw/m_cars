<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;

    // Add product to user's cart

    public function addToCart()
    {
        if (Auth::check()) {
            dd($this->product);
        } else {
            return redirect()->route('auth.login');
        }
    }
    public function render()
    {
        return view('livewire.product-card');
    }
}
