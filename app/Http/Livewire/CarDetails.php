<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarDetails extends Component
{
    public Car $car;
    public $selected_car_image;
    public function mount(Car $car)
    {
        if ($car->images != null) {
            $this->selected_car_image = $car->images[0];
        }
        $this->car = $car;
    }


    public function render()
    {
        return view('livewire.car-details')
            ->extends('layouts.app');
    }
}
