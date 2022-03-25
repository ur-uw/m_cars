<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class TheNavDropDown extends Component
{
    public $name;
    public $email;
    public $image;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
    }
    protected $listeners = ['profile_updated' => 'updateProfile'];

    public function updateProfile()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
    }
    public function render()
    {
        return view('livewire.the-nav-drop-down');
    }
}
