<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'price' => rand(4, 100),
            'image' => $this->faker->image(),
        ];
    }
}
