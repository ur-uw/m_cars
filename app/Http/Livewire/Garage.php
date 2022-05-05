<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\UserCarRent;
use Auth;
use Livewire\Component;

class Garage extends Component
{
    public  $cars;
    public $page = 1;

    public function mount($page)
    {
        $this->page = $page;
        if ($page == 1) {
            $this->cars =  Car::with(['details', 'manufacturer'])
                ->where('user_id', Auth::user()->id)
                ->get();
        } else {
            $rentedCarsIds = UserCarRent::where('user_id', Auth::user()->id)
                ->whereDate('end_date', '>', now())
                ->get()
                ->pluck('car_id')
                ->toArray();
            if (!empty($rentedCarsIds)) {
                $this->cars =  Car::with(['details', 'manufacturer'])
                    ->whereIn('id', $rentedCarsIds)
                    ->get();
            } else {
                $this->cars =  [];
            }
        }
    }

    public function render()
    {
        return view('livewire.garage')
            ->extends('layouts.app');
    }
}
