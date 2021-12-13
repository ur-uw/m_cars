<?php

namespace App\Http\Livewire;

use App\Models\SparePart;
use App\Models\SpareType;
use Livewire\Component;

class SparePartsList extends Component
{
    public SpareType $spare_type;
    public $spare_parts;
    public function mount()
    {
        $this->spare_parts = $this->spare_type->spareParts;
    }
    public function render()
    {
        return view(
            'livewire.spare-parts-list'
        )->extends('layouts.app');
    }
}
