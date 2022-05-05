<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SparePart;
use App\Models\SpareType;
use Livewire\Component;

class SpareTypesList extends Component
{
    public $spare_categories;
    public function mount()
    {
        $this->spare_categories = Category::firstWhere('name', 'Spare Parts')
            ->children()
            ->latest()
            ->orderBy('name')
            ->get();
    }
    public function render()
    {
        return view('livewire.spare-types-list')
            ->extends('layouts.app');
    }
}
