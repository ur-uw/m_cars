<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Garage extends Component
{
    use WithPagination;
    public $term;
    public function render()
    {
        return view('livewire.garage', [
            'cars' => Car::where('user_id', Auth::user()->id)
                ->search($this->term)
                ->paginate(8),
        ])->extends('layouts.app');
    }
}
