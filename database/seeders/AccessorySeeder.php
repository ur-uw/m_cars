<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\AccessoryType;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessoryTypes = AccessoryType::all();
        $accessoryTypes->each(function (AccessoryType $accessoryType) {
            $accessoriesImages = Storage::allFiles("public/accessories/" . Str::snake($accessoryType->name));
            foreach ($accessoriesImages as $accessoryImage) {
                if (preg_match('~\.(jpeg|jpg|png)$~', $accessoryImage)) {
                    $accessory = Accessory::factory([
                        'image' => $accessoryImage,
                    ])->make();
                    $accessory->manufacturer_id = Manufacturer::inRandomOrder()->first()->id;
                    $accessory->accessory_type_id = $accessoryType->id;
                    $accessory->save();
                }
            }
        });
    }
}
