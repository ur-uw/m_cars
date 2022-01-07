<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\AccessoryType;
use App\Models\Manufacturer;
use Livewire\Component;

class AccessoriesList extends Component
{
    public AccessoryType $accessory_type;
    public $term;
    public $filterManufacturer;
    public $manufacturers;

    public function loadManufacturers()
    {
        if (!$this->manufacturers) {
            $this->manufacturers = Manufacturer::latest()
                ->orderBy('name')
                ->get();
        }
    }

    public function render()
    {
        return view(
            'livewire.accessories-list',
            [
                'accessories' => Accessory::where('accessory_type_id', $this->accessory_type->id)
                    ->when($this->filterManufacturer, function ($query, $man) {
                        return $query->where('manufacturer_id', $man);
                    })
                    ->search($this->term)
                    ->get(),
            ]
        )->extends('layouts.app');
    }
}
