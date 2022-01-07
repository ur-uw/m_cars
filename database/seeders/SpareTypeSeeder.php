<?php

namespace Database\Seeders;

use App\Models\SpareType;
use App\Utility\DirectoryUtils;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;
use Storage;
use Faker\Factory as Faker;
use Str;

class SpareTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // SpareType::factory(11)->create();
        $spare_types = Storage::directories('public/spare_parts');
        foreach ($spare_types as $spare_type) {
            $dirFiles = Storage::files($spare_type);
            $dirName = DirectoryUtils::dirNameFromStorage($spare_type);
            $spareImage = null;

            // Print the entire match result
            for ($i = 0; $i < count($dirFiles); $i++) {
                ///check if the image name is the same as folder name
                if (Str::matchAll('/[ \w-]+?(?=\.)/i', $dirFiles[$i])->contains($dirName)) {
                    $spareImage = $dirFiles[$i];
                    break;
                }
            }
            SpareType::create([
                'name' => DirectoryUtils::snakeToNormal($dirName),
                'image' =>  $spareImage ?? $faker->imageUrl(),
            ]);
        }
    }
}
