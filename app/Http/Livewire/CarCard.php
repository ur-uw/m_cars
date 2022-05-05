<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarCard extends Component
{
    public Car $car;
    // flag to indecate if the data of cars is from seeder of from cars api
    public $useRealData = true;

    public function render()
    {
        return view('livewire.car-card');
    }
}
