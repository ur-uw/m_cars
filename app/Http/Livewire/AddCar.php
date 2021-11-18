<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCar extends Component
{
    public function render()
    {
        return view('livewire.add-car')
            ->extends('layouts.app');
    }
}
