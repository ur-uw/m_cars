<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicePlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Car Service', 'Car Care'];
        foreach ($types as $type) {
            \App\Models\ServicePlaceType::create([
                'name' => $type,
            ]);
        }
    }
}
