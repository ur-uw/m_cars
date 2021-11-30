<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\CarDetails;
use App\Models\Manufacturer;
use App\Models\Type;
use Auth;
use Livewire\Component;

class CarAdd extends Component
{
    public $currentPage = 0;
    public $fuel_type = 'benzin';
    public $model;
    public $color;
    public $price;
    public $plate_number;
    public $type;
    public $manufacturer;
    public $manufactured_at;
    public $description;
    public $tank_capacity;
    public $battery_capacity;
    public $engine_capacity;
    public $fuel_economy;
    public $top_speed;
    public $acceleration;
    public $gearbox_speeds;
    public $number_cylinders;
    public $seating_capacity;
    public $drive_mode;
    public $is_four_wheel;
    public $is_auto_drive;
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
    public function submit()
    {
        $this->validate([
            'model' => 'required|string|max:20',
            'description' => 'string|max:100',
            'color' => 'required|string|max:9',
            'price' => 'required|numeric',
            'plate_number' => 'required|string',
            'manufactured_at' => 'required|date',
            'type' => 'required|string',
            'fuel_type' => 'required|string',
            'manufacturer' => 'required|string',
            'tank_capacity' => 'required|numeric',
            'fuel_economy' => 'required|numeric',
            'top_speed' => 'required|numeric',
            'gearbox_speeds' => 'required|numeric',
            'acceleration' => 'required|numeric',
            'engine_capacity' => 'required|numeric',
            'number_cylinders' => 'required|numeric',
            'seating_capacity' => 'required|numeric',
            'drive_mode' => 'required|string',
        ]);
        $car_details = CarDetails::make([
            'color' => $this->color,
            'is_four_wheel' => $this->is_four_wheel ?? false,
            'tank_capacity' => $this->tank_capacity,
            'fuel_type' => $this->fuel_type,
            'fuel_economy' => $this->fuel_economy,
            'battery_capacity' => $this->battery_capacity,
            'top_speed' => $this->top_speed,
            'acceleration' => $this->acceleration,
            'seating_capacity' => $this->seating_capacity,
            'is_auto_drive' => $this->is_auto_drive ?? false,
            'plate_number' => $this->plate_number,
            'driving_mode' => $this->drive_mode,
            'manufactured_at' => $this->manufactured_at,
            'description' => $this->description,
            'price' => $this->price,
            'number_of_cylinders' => $this->number_cylinders,
            'engine_capacity' => $this->engine_capacity,
            'gearbox_speeds' => $this->gearbox_speeds,
        ]);
        $car = Car::create([
            'model' => $this->model,
            'manufacturer_id' => $this->manufacturer,
            'thumb_nail' => 'some_image',
            'type_id' => $this->type,
            'user_id' => Auth::user()->id,
        ]);
        $car->details()->save($car_details);
        $this->reset();
        $this->currentPage = 0;
    }
    public function render()
    {
        return view('livewire.car-add', [
            'manufacturers' => Manufacturer::orderBy('name')
                ->get(),
            'types' => Type::orderBy('name')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
