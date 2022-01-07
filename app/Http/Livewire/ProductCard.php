<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\SparePart;
use Livewire\Component;

class ProductCard extends Component
{
    public SparePart|Accessory $product;
    public function render()
    {
        return view('livewire.product-card');
    }
}
