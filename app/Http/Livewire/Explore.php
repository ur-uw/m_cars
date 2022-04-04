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
        if (session()->has('login:success')) {
            $msg = session()->get('login:success');
            toast("Welcome Back $msg", 'success');
        } else if (session()->has('register:success')) {
            $msg = session()->get('register:success');
            toast("Welcome $msg", 'success');
        }
    }
    public function render()
    {
        return view(
            'livewire.explore',
            [
                'cars' =>  Car::with(['details', 'category', 'manufacturer'])
                    ->where('action', '!=', null)
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
