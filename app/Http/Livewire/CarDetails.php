<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\UserCarRent;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CarDetails extends Component
{
    public Car $car;
    public $selected_car_image;
    public $renting_period;
    public $showRentingForm = false;
    // flag to indicate if the data of cars is from seeder of from cars api
    public $useRealData = true;
    public $showAddToGarage = true;
    public $showRentBtn = true;

    public function mount(Car $car)
    {
        if ($car->images != null) {
            $this->selected_car_image = $car->images[0];
        }
        $this->car = $car;
        $this->showAddToGarage = !$car->user && $car->action == 'FOR_SALE';
        $end_date = UserCarRent::latest('end_date')
            ->where('car_id', $car->id)
            ->first()?->end_date;
        $isRented = $end_date != null ? $end_date > now() : false;
        $this->showRentBtn = !$isRented && !$this->showRentingForm;
    }

    public function updatedShowRentingForm()
    {
        $this->showRentBtn =  !$this->showRentingForm;
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
    // Rent car for specific period
    public function rentCar()
    {
        if (Auth::check()) {
            $this->validate([
                'renting_period' => 'required|numeric|min:1',
            ]);
            session(['car_image' => $this->selected_car_image, 'rent_period' => intval($this->renting_period)]);
            redirect()->route('checkout.car.show', ['car' => $this->car]);
            $this->showRentBtn = false;
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
