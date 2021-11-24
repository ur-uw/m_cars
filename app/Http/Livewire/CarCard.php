<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarCard extends Component
{
    public $car;
    public function render()
    {
        return view('livewire.car-card');
    }
}
