<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\Category;
use App\Models\Manufacturer;
use Livewire\Component;
use Livewire\WithPagination;

class Explore extends Component
{
    use WithPagination;
    public $term;
    public $filterManufacturer;
    public $filterType;

    public function updatingTerm()
    {
        $this->resetPage();
    }
    public function updatingFilterManufacturer()
    {
        $this->resetPage();
    }
    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function mount()
    {
        if (session()->has('success')) {
            $msg = session()->get('success');
            toast($msg, 'success');
        }
    }
    public function render()
    {
        return view(
            'livewire.explore',
            [
                'cars' =>  Car::with(['details', 'category', 'manufacturer'])
                    ->where('action', '!=', null)
                    ->where('user_id', null)
                    ->when($this->filterManufacturer, function ($query, $manufacturer) {
                        return $query->where('manufacturer_id', $manufacturer);
                    })->when($this->filterType, function ($query, $type) {
                        return $query->where('category_id', $type);
                    })
                    ->search(trim($this->term))
                    ->paginate(8),
                'manufacturers' => Manufacturer::orderBy('name')->get(),
                'types' => Category::firstWhere('name', 'Cars')
                    ->children()
                    ->orderBy('name')
                    ->get(),
            ],
        )->extends('layouts.app');
    }
}
