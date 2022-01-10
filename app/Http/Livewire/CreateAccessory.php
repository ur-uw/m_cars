<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\AccessoryType;
use App\Models\Manufacturer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class CreateAccessory extends Component
{

    use WithFileUploads;
    public $name;
    public $price;
    public $image;
    public $accessoryType;
    public $manufacturer;


    protected $rules = [
        'name' => 'required|string|max:20',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=670,max_height=350',
        'accessoryType' => 'required|exists:App\Models\SpareType,id',
        'manufacturer' => 'required|exists:App\Models\Manufacturer,id',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate($this->rules);
        $sparePath = 'public/accessories/' . Str::snake(AccessoryType::firstWhere('id', $this->accessoryType)->name);
        Storage::makeDirectory($sparePath);
        $spareImage =  $this->image->store($sparePath);
        Accessory::create([
            'name' => $this->name,
            'accessory_type_id' => $this->accessoryType,
            'manufacturer_id' => $this->manufacturer,
            'image' => $spareImage,
            'price' => $this->price,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-accessory', [
            'accessoryTypes' => AccessoryType::latest()
                ->orderBy('name')
                ->get(),
            'manufacturers' => Manufacturer::latest()
                ->orderBy('name')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
