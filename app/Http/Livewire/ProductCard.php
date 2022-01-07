<?php

namespace App\Http\Livewire;

use App\Models\SparePart;
use Livewire\Component;

class ProductCard extends Component
{
    public SparePart $spare;
    public function render()
    {
        return view('livewire.product-card');
    }
}
