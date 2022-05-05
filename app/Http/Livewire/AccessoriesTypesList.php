<?php

namespace App\Http\Livewire;

use App\Models\AccessoryType;
use App\Models\Category;
use Livewire\Component;

class AccessoriesTypesList extends Component
{
    public $category;
    public function mount()
    {
        $this->category = Category::firstWhere('name', 'Accessories')
            ->children()
            ->latest()
            ->orderBy('name')
            ->get();
    }
    public function render()
    {
        return view('livewire.accessories-types-list')
            ->extends('layouts.app');
    }
}
