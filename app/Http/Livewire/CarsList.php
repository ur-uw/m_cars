<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\Manufacturer;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class CarsList extends Component
{
    use WithPagination;
    public $term;
    public $filterManufacturer;
    public $filterType;

    public function updatingTerm()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view(
            'livewire.cars-list',
            [
                'cars' =>  Car::with(['details', 'manufacturer', 'type'])
                    ->when($this->filterManufacturer, function ($query, $manufacturer) {
                        return $query->where('manufacturer_id', $manufacturer);
                    })->when($this->filterType, function ($query, $type) {
                        return $query->where('type_id', $type);
                    })
                    ->search(trim($this->term))
                    ->paginate(8),
                'manufacturers' => Manufacturer::all(),
                'types' => Type::all(),
            ],
        );
    }
}
