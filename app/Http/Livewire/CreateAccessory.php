<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
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
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'accessoryType' => 'required|exists:App\Models\Category,id',
        'manufacturer' => 'required|exists:App\Models\Manufacturer,id',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate($this->rules);
        $sparePath = 'public/accessories/' . Str::snake(Product::firstWhere('id', $this->accessoryType)->name);
        Storage::makeDirectory($sparePath);
        $spareImage =  $this->image->store($sparePath);
        Product::create([
            'name' => $this->name,
            'category_id' => $this->accessoryType,
            'manufacturer_id' => $this->manufacturer,
            'image' => $spareImage,
            'price' => $this->price,
        ]);
        session()->flash('success', 'Accessory Created Successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-accessory', [
            'accessoryTypes' => Category::firstWhere('name', 'Accessories')
                ->children()
                ->latest()
                ->orderBy('name')
                ->get(),
            'manufacturers' => Manufacturer::latest()
                ->orderBy('name')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
