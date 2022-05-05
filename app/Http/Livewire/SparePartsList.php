<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Livewire\Component;

class SparePartsList extends Component
{
    public Category $category;
    public $term;
    public $filterManufacturer;



    public function render()
    {
        return view(
            'livewire.spare-parts-list',
            [
                'spare_parts' => Product::with('manufacturer')->where('category_id', $this->category->id)
                    ->when($this->filterManufacturer, function ($query, $man) {
                        return $query->where('manufacturer_id', $man);
                    })
                    ->search($this->term)
                    ->get(),
                'manufacturers' =>  Manufacturer::latest()
                    ->orderBy('name')
                    ->get()
            ]
        )->extends('layouts.app');
    }
}
