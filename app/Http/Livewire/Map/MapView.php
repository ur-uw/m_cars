<?php

namespace App\Http\Livewire\Map;

use App\Models\ServicePlace;
use Livewire\Component;

class MapView extends Component
{
    public function render()
    {
        return view('livewire.map.map-view', [
            'places' => ServicePlace::all(),
        ])
            ->extends('layouts.app');
    }
}
