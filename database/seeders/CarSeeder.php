<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarDetails;
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
        $types_count = Type::count();
        Manufacturer::all()->each(function (Manufacturer $manufacturer) use ($types_count) {
            $cars =  Car::factory(rand(1, 3))->make([
                'type_id' => rand(1, $types_count),
            ]);
            $manufacturer->cars()->saveMany($cars);
        });
    }
}
