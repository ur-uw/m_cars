<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SparePartCard extends Component
{
    public $spare_part_name;
    public $spare_part_image;
    public function render()
    {
        return view('livewire.spare-part-card');
    }
}
