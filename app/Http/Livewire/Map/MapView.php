<?php

namespace App\Http\Livewire\Map;

use Livewire\Component;

class MapView extends Component
{
    public function render()
    {
        return view('livewire.map.map-view')
            ->extends('layouts.app');
    }
}
