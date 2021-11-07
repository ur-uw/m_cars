<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class ListCars extends Component
{
    public $term;

    public function render()
    {
        return view('livewire.list-cars', ['cars' => Car::when($this->term, function ($query, $term) {
            return $query->where('model', 'LIKE', "%$term%")->orWhere('manufacturer', 'LIKE', "%$term%");
        })->paginate(10)]);
    }
}
