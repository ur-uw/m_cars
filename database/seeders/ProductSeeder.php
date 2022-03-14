<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get categories for Spare Parts and Accessories
        $parent_categories = Category::where('name', 'Spare Parts')
            ->orWhere('name', 'Accessories')
            ->get();
        $categories = Category::whereIn('parent_id', $parent_categories->pluck('id'));
        $categories->each(function (Category $category) {
            $productImagesPath = "public/" . Str::snake(Category::where('id', $category->parent_id)->first()->name) . '/' . Str::snake($category->name);
            $productImages = Storage::allFiles($productImagesPath);
            foreach ($productImages as $productImage) {
                if (preg_match('~\.(jpeg|jpg|png)$~', $productImage)) {
                    Product::factory([
                        'image' => $productImage
                    ])->create([
                        'manufacturer_id' =>  Manufacturer::inRandomOrder()->first()->id,
                        'category_id' => $category->id,
                    ]);
                }
            }
        });
    }
}
