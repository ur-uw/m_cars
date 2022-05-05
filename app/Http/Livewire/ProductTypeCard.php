<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductTypeCard extends Component
{
    public $product_type_name;
    public $product_type_image;
    public function render()
    {
        return view('livewire.product-type-card');
    }
}
