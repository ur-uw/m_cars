<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarCard extends Component
{
    public Car $car;
    public function render()
    {
        return view('livewire.car-card');
    }
}
