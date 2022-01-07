<?php

namespace Database\Seeders;

use App\Models\AccessoryType;
use App\Utility\DirectoryUtils;
use Illuminate\Database\Seeder;
use Storage;
use Faker\Factory as Faker;
use Str;

class AccessoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $accessories = Storage::directories('public/accessories');
        foreach ($accessories as $accessory) {
            $dirFiles = Storage::files($accessory);
            $dirName = DirectoryUtils::dirNameFromStorage($accessory);
            $accessoryImage = null;

            // Print the entire match result
            for ($i = 0; $i < count($dirFiles); $i++) {
                ///check if the image name is the same as folder name
                if (Str::matchAll('/[ \w-]+?(?=\.)/i', $dirFiles[$i])->contains($dirName)) {
                    $accessoryImage = $dirFiles[$i];
                    break;
                }
            }
            AccessoryType::create([
                'name' => DirectoryUtils::snakeToNormal($dirName),
                'image' =>  $accessoryImage ?? $faker->imageUrl(),
            ]);
        }
    }
}
