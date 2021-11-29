<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarAdd extends Component
{
    public $currentPage = 0;
    public $fuelType = 'benzin';
    public $pages = [
        0 => [
            'heading' => "General Car Info",
        ],
        1 => [
            'heading' => 'Car Details'
        ],
        2 => [
            'heading' => 'Car Images',
        ],
    ];

    public function nextPage()
    {
        if ($this->currentPage + 1 < count($this->pages)) {
            $this->currentPage += 1;
        }
    }
    public function previousPage()
    {
        if ($this->currentPage > 0) {
            $this->currentPage -= 1;
        }
    }
    public function setPage($page)
    {
        if ($this->currentPage != $page) {
            $this->currentPage = $page;
        }
    }

    public function render()
    {
        return view('livewire.car-add')
            ->extends('layouts.app');
    }
}
