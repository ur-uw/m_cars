<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $manufactures = [
            'Mercedes', 'Nissan', 'Toyota', 'Porsche', 'Ford', 'Audi'
        ];

        $types = ['Suv', 'Sports', 'Sedan', 'Minivan'];
        return [
            'manufacturer' => $this->faker->randomElement($manufactures),
            'model' => 'Model ' . random_int(1, 4),
            'type' => $this->faker->randomElement($types),
            'manufactured_at' => $this->faker->date(),
        ];
    }
}
