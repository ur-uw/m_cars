<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarDetails;
use Illuminate\Database\Seeder;

class CarDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::all()->each(function (Car $car) {
            CarDetails::factory()->create([
                'car_id' => $car->id,
            ]);
        });
    }
}
