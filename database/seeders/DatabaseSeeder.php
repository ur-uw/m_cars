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
            TypeSeeder::class,
            ManufacturerSeeder::class,
            CarSeeder::class,
            CarDetailsSeeder::class,
            SpareTypeSeeder::class,
            SparePartSeeder::class,
            AccessoryTypeSeeder::class,
            AccessorySeeder::class,
        ]);
    }
}
