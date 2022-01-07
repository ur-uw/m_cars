<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductTypeCard extends Component
{
    public $spare_type_name;
    public $spare_type_image;
    public function render()
    {
        return view('livewire.product-type-card');
    }
}
