<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarDetails;
use App\Models\Manufacturer;
use App\Models\Type;
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
        $manufacturer = Manufacturer::all();
        $types_count = Type::count();
        $manufacturer->each(function (Manufacturer $manufacturer) use ($types_count) {
            Car::factory()->create([
                'manufacturer_id' => $manufacturer->id,
                'type_id' => rand(1, $types_count)
            ]);
        });
    }
}
