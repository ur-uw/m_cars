<?php

namespace App\Http\Livewire;

use App\Models\SparePart;
use App\Models\SpareType;
use Livewire\Component;

class SpareTypesList extends Component
{
    public $spare_types;
    public function mount()
    {
        $this->spare_types = SpareType::latest()
            ->orderBy('name')
            ->get();
    }
    public function render()
    {
        return view('livewire.spare-types-list')
            ->extends('layouts.app');
    }
}
