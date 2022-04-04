<?php

namespace Database\Seeders;

use App\Models\ServicePlace;
use Illuminate\Database\Seeder;
use Storage;

class ServicePlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_places = json_decode(
            Storage::get('json/service_places.json'),
            true
        );
        foreach ($service_places as $service_place) {
            ServicePlace::create([
                'name' => $service_place['name'],
                'description' => $service_place['description'],
                'latitude' => $service_place['latitude'],
                'longitude' => $service_place['longitude'],
                'phone_number' => $service_place['phone_number'],
                'service_place_type_id' => rand(1, 2),
            ]);
        }
    }
}
