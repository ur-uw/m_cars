<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        Address::factory()->count(count($users))->make()->each(function ($address) use ($users) {
            $address->user()->associate($users->random());
            $address->save();
        });
    }
}
