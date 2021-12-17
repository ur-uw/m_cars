<?php

namespace App\Http\Livewire;

use App\Models\Manufacturer;
use App\Models\SparePart;
use App\Models\SpareType;
use Livewire\Component;

class SparePartsList extends Component
{
    public SpareType $spare_type;
    public $term;
    public $filterManufacturer;
    public function render()
    {
        return view(
            'livewire.spare-parts-list',
            [
                'spare_parts' => SparePart::where('spare_type_id', $this->spare_type->id)
                    ->when($this->filterManufacturer, function ($query, $man) {
                        return $query->where('manufacturer_id', $man);
                    })
                    ->search($this->term)
                    ->get(),
                'manufacturers' => Manufacturer::latest()
                    ->orderBy('name')
                    ->get(),
            ]
        )->extends('layouts.app');
    }
}
