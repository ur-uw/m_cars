<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use App\Models\SparePart;
use App\Models\SpareType;
use Illuminate\Database\Seeder;
use Storage;
use Str;

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
            $sparePartsImages = Storage::allFiles("public/spare_parts/" . Str::snake($spareType->name));
            foreach ($sparePartsImages as $sparePartImage) {
                if (preg_match('~\.(jpeg|jpg|png)$~', $sparePartImage)) {
                    $sparePart = SparePart::factory([
                        'image' => $sparePartImage,
                    ])->make();
                    $sparePart->manufacturer_id = Manufacturer::inRandomOrder()->first()->id;
                    $sparePart->spare_type_id = $spareType->id;
                    $sparePart->save();
                }
            }
        });
    }
}
