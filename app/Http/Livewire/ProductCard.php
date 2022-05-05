<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Auth;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;

class ProductCard extends Component
{
    public $product;
    public $cart;

    protected $listeners = ['cart_updated' => 'updateCart'];

    public function updateCart()
    {
        $this->cart = CartFacade::content();
    }

    public function mount()
    {
        $this->cart = CartFacade::content();
    }

    // Add product to user's cart
    public function addToCart($product_id)
    {
        if (Auth::check()) {
            $product = Product::findOrFail($product_id);
            CartFacade::add(
                $product->id,
                $product->name,
                1,
                $product->price / 100,
                0,
                [
                    'image' => $product->image,
                    'description' => $product->description,
                ]
            )->associate('App\Models\Product');

            $this->emit('cart_updated');
        } else {
            return redirect()->route('auth.login');
        }
    }
    public function render()
    {
        return view('livewire.product-card');
    }
}
