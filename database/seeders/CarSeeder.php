<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarDetails;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Cars table
        Manufacturer::all()->each(function (Manufacturer $manufacturer) {
            Car::factory(rand(1, 3))->create([
                'category_id' => Category::where('name', 'Cars')->inRandomOrder()->first()->id,
                'manufacturer_id' => $manufacturer->id,
            ]);
        });
    }
}
