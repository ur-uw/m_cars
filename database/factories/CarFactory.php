<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;

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
        $carsImages = Storage::allFiles('public/cars');
        $actions = ['FOR_SALE', 'FOR_RENT'];
        return [
            'model' => 'Model ' . random_int(1, 4),
            'thumb_nail' => $this->faker->randomElement($carsImages),
            'action' => $this->faker->randomElement($actions),
        ];
    }
}
