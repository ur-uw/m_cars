<?php

namespace App\Http\Livewire;

use App\Models\SparePart;
use Livewire\Component;

class SparePartCard extends Component
{
    public SparePart $spare;
    public function render()
    {
        return view('livewire.spare-part-card');
    }
}
