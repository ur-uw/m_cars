<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarDetails extends Component
{
    public function render()
    {
        return view('livewire.car-details')
            ->extends('layouts.app');
    }
}
