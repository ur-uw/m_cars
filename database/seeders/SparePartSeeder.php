<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use App\Models\SparePart;
use App\Models\SpareType;
use Illuminate\Database\Seeder;

class SparePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spareTypes = SpareType::all();
        $spareTypes->each(function (SpareType $spareType) {
            $sparePart = SparePart::factory()->make();
            $sparePart->manufacturer_id = Manufacturer::inRandomOrder()->first()->id;
            $sparePart->spare_type_id = $spareType->id;
            $sparePart->save();
        });
    }
}
