<?php

namespace Database\Seeders;

use App\Models\SpareType;
use Illuminate\Database\Seeder;

class SpareTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpareType::factory(11)->create();
    }
}
