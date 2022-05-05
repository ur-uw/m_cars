<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Auth;
use Livewire\Component;
use Session;

class CarDetails extends Component
{
    public Car $car;
    public $selected_car_image;
    // flag to indicate if the data of cars is from seeder of from cars api
    public $useRealData = true;
    public $showAddToGarage = true;

    public function mount(Car $car)
    {
        if ($car->images != null) {
            $this->selected_car_image = $car->images[0];
        }
        $this->car = $car;
        $this->showAddToGarage = !$car->user;
    }

    // Add the car for user garage
    public function addToGarage()
    {
        if (Auth::check()) {
            session(['car_image' => $this->selected_car_image]);
            redirect()->route('checkout.car.show', ['car' => $this->car]);
            $this->showAddToGarage = false;
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
