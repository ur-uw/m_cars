<?php
// TODO: use sweet alert when car is created
namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\CarDetails;
use App\Models\Category;
use App\Models\Manufacturer;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarCreate extends Component
{
    use WithFileUploads;
    public $currentPage = 0, $fuel_type, $model, $color, $price, $plate_number, $type, $manufacturer, $manufactured_at, $description, $tank_capacity, $battery_capacity, $engine_capacity, $fuel_economy, $top_speed, $acceleration, $gearbox_speeds, $number_cylinders, $seating_capacity, $drive_mode, $is_four_wheel, $is_auto_drive, $car_thumbnail, $action, $formMyGarage = true, $car_images = [], $pages = [
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

    protected $rules = [
        'model' => 'required|string|max:20',
        'description' => 'string|nullable|max:100',
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
        'car_thumbnail' =>
        'required|image|mimes:jpeg,png,jpg|max:2048',
        'car_images.*' =>
        'required|image|mimes:jpeg,png,jpg|max:10240',
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
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function getUserId(): int|null
    {
        $isAdmin = Auth::user()->is_admin;
        if ($isAdmin) {
            return $this->formMyGarage ? Auth::user()->id : null;
        }
        return Auth::user()->id;
    }

    public function submit()
    {
        $this->validate($this->rules);
        $thumbnail =  $this->car_thumbnail->store('public/cars');
        $carImages =  [];
        foreach ($this->car_images as $car_image) {
            array_push($carImages, $car_image->store('public/cars'));
        }
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
            'thumb_nail' => $thumbnail,
            'action' => $this->action,
            'images' => $carImages,
            'category_id' => $this->type,
            'user_id' => $this->getUserId(),
        ]);
        $car->details()->save($car_details);
        $this->reset();
        $this->currentPage = 0;
        session()->flash('success', 'Car Added Successfully');
    }
    public function render()
    {
        return view('livewire.car-create', [
            'manufacturers' => Manufacturer::orderBy('name')
                ->get(),
            'types' => Category::firstWhere('name', 'Cars')
                ->children()
                ->orderBy('name')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
