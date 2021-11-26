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
        User::all()->each(function (User $user) use ($types_count) {
            $cars =  Car::factory(rand(1, 3))->make([
                'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id,
                'type_id' => rand(1, $types_count),
            ]);
            $user->cars()->saveMany($cars);
        });
    }
}
