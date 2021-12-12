<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SpareTypeCard extends Component
{
    public $spare_type_name;
    public $spare_type_image;
    public function render()
    {
        return view('livewire.spare-type-card');
    }
}
