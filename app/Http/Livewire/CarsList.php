<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarsList extends Component
{
    public $term;

    public function render()
    {
        return view(
            'livewire.cars-list',
            [
                'cars' => Car::with(['details', 'manufacturer', 'type'])->when($this->term, function ($query, $term) {
                    return $query->where('model', 'LIKE', "%$term%")->orWhere('manufacturer', 'LIKE', "%$term%");
                })->paginate(10),
            ],
        );
    }
}
