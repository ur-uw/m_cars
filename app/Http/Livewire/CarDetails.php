<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarDetails extends Component
{
    public Car $car;
    public function mount(Car $car)
    {
        $this->car = $car;
    }
    public function render()
    {
        return view('livewire.car-details')
            ->extends('layouts.app');
    }
}
