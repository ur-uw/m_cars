<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;

class CartProductRow extends Component
{

    public Product $product;
    public int $quantity;
    public $cart;
    public $rowId;

    public function mount()
    {
        $this->rowId = $this->getRowId($this->product->id);
        $this->quantity = $this->cart->where('rowId', $this->rowId)->first()->qty;
    }

    /**
     * Get row id of product in the cart
     *
     *
     * @param int $product_id Product id
     * @return string
     **/
    public function getRowId($product_id): string
    {
        $product = Product::findOrFail($product_id);
        // Get product rowId in the cart
        return $this->cart->where('id', $product->id)->first()->rowId;
    }

    /**
     * Decrease product quantity in the cart
     *
     *
     * @param int $product_id Product id
     * @return void
     **/
    public function decreaseProductQty()
    {
        // Get the item by rowId in the cart
        $item = CartFacade::get($this->rowId);
        $newQuantity = $item->qty - 1;
        if ($newQuantity != 0) {
            CartFacade::update($this->rowId, $newQuantity);
            $this->quantity = $newQuantity;
        } else {
            CartFacade::remove($this->rowId);
        }
        $this->emit('cart_updated');
    }



    /**
     * Remove product from the cart.
     *
     *
     * @param int $product_id Product id
     * @return void
     **/
    public function removeFromCart()
    {
        CartFacade::remove($this->rowId);
        $this->emit('cart_updated');
    }

    /**
     * Add product to the cart.
     *
     *
     * @param int $product_id Product id
     * @return void
     **/
    public function increaseItemQty($product_id)
    {
        $newQuantity = ($this->cart->where('id', $product_id)->first()['qty'] ?? 0) + 1;
        CartFacade::update(
            $this->rowId,
            $newQuantity,
        );
        $this->quantity = $newQuantity;
        $this->emit('cart_updated');
    }
    public function render()
    {
        return view('livewire.cart.cart-product-row');
    }
}
