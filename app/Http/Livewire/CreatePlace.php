<?php

namespace App\Http\Livewire;

use App\Models\ServicePlace;
use App\Models\ServicePlaceType;
use Livewire\Component;

class CreatePlace extends Component
{
    public $name, $phone, $latitude, $longitude, $description, $type;

    /** @var array $rules validation rules */
    protected $rules = [
        'name' => 'required|min:8|max:25|unique:service_places',
        'phone' => 'required|min:10',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'type' => 'required|exists:App\Models\ServicePlaceType,id',
        'description' => 'nullable|string|min:10|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    /**
     * Submit input to create a new service place
     *
     * @return void
     **/
    public function submit(): void
    {
        $this->validate($this->rules);
        ServicePlace::create([
            'name' => $this->name,
            'description' => $this->description,
            'phone_number' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'service_place_type_id' => $this->type,
        ]);
        $this->reset();
        session()->flash('success', 'Place created successfully');
    }

    public function render()
    {
        return view(
            'livewire.create-place',
            [
                'placeTypes' => ServicePlaceType::select(['id', 'name'])->get(),
            ]
        )
            ->extends('layouts.app');
    }
}
