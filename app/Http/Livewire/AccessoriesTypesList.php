<?php

namespace App\Http\Livewire;

use App\Models\AccessoryType;
use Livewire\Component;

class AccessoriesTypesList extends Component
{
    public $accessoryTypes;
    public function mount()
    {
        $this->accessoryTypes = AccessoryType::latest()
            ->orderBy('name')
            ->get();
    }
    public function render()
    {
        return view('livewire.accessories-types-list')
            ->extends('layouts.app');
    }
}
