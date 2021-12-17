<?php

namespace Database\Seeders;

use App\Models\SpareType;
use App\Utility\DirectoryUtils;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;
use Storage;
use Faker\Factory as Faker;


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
            SpareType::create([
                'name' => DirectoryUtils::snakeToNormal(
                    DirectoryUtils::dirNameFromStorage($spare_type)
                ),
                'image' =>  $faker->imageUrl(),
            ]);
        }
    }
}
