<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AddressSeeder::class,
            CategorySeeder::class,
            ManufacturerSeeder::class,
            CarSeeder::class,
            CarDetailsSeeder::class,
            ProductSeeder::class,
            ServicePlaceTypeSeeder::class,
            ServicePlaceSeeder::class,
        ]);
    }
}
