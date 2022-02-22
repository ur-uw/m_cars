<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Auth;
use Livewire\Component;

class CarDetails extends Component
{
    public Car $car;
    public $selected_car_image;
    // flag to indecate if the data of cars is from seeder of from cars api
    public $useRealData = true;
    public function mount(Car $car)
    {
        if ($car->images != null) {
            $this->selected_car_image = $car->images[0];
        }
        $this->car = $car;
    }

    // Add the car for user garage
    public function addToGarage()
    {
        if (Auth::check()) {

            dd($this->car);
        } else {
            redirect()->route('auth.login');
        }
    }

    public function render()
    {
        return view('livewire.car-details')
            ->extends('layouts.app');
    }
}
