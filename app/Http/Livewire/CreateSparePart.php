<?php

namespace App\Http\Livewire;

use App\Models\Manufacturer;
use App\Models\SparePart;
use App\Models\SpareType;
use App\Utility\DirectoryUtils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class CreateSparePart extends Component
{
    use WithFileUploads;
    public $name;
    public $price;
    public $image;
    public $spareType;
    public $manufacturer;


    protected $rules = [
        'name' => 'required|string|max:20',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=670,max_height=350',
        'spareType' => 'required|exists:App\Models\SpareType,id',
        'manufacturer' => 'required|exists:App\Models\Manufacturer,id',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate($this->rules);
        $sparePath = 'public/spare_parts/' . Str::snake(SpareType::firstWhere('id', $this->spareType)->name);
        Storage::makeDirectory($sparePath);
        $spareImage =  $this->image->store($sparePath);
        SparePart::create([
            'name' => $this->name,
            'spare_type_id' => $this->spareType,
            'manufacturer_id' => $this->manufacturer,
            'image' => $spareImage,
            'price' => $this->price,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-spare-part', [
            'spareTypes' => SpareType::latest()
                ->orderBy('name')
                ->get(),
            'manufacturers' => Manufacturer::latest()
                ->orderBy('name')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
