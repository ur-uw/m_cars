<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use App\Utility\DirectoryUtils;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $parent_categories = ['Cars', 'Spare Parts', 'Accessories'];
        // Seed parent categories
        foreach ($parent_categories as $parent_category) {
            Category::create([
                'name' => $parent_category,
            ]);
        }
        // Seed Cars category
        // Seed car parent categories with sub categories
        $car_categories_names = ['Sport', 'Minivan', 'Sedan', 'Suv'];

        foreach ($car_categories_names as $car_category_name) {
            $category = Category::create([
                'name' => $car_category_name,
                'parent_id' => Category::where('name', 'Cars')->first()->id,
            ]);
            // Push category id to car_categories
        }
        // Seed spare parts category
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
            Category::create([
                'name' => DirectoryUtils::snakeToNormal($dirName),
                'image' =>  $spareImage ?? $faker->imageUrl(),
                'parent_id' => Category::where('name', 'Spare Parts')->first()->id,
            ]);
        }
        // Seed accessories category
        $accessory_types = Storage::directories('public/accessories');
        foreach ($accessory_types as $accessory_type) {
            $dirFiles = Storage::files($accessory_type);
            $dirName = DirectoryUtils::dirNameFromStorage($accessory_type);
            $accessory_image = null;

            for ($i = 0; $i < count($dirFiles); $i++) {
                ///check if the image name is the same as folder name
                if (Str::matchAll('/[ \w-]+?(?=\.)/i', $dirFiles[$i])->contains($dirName)) {
                    $accessory_image = $dirFiles[$i];
                    break;
                }
            }
            Category::create([
                'name' => DirectoryUtils::snakeToNormal($dirName),
                'image' =>  $accessory_image ?? $faker->imageUrl(),
                'parent_id' => Category::where('name', 'Accessories')->first()->id,
            ]);
        }
    }
}
