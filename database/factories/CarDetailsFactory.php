<?php

namespace Database\Factories;

use App\Models\CarDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarDetails::class;

    /*
       'color',
        'is_four_wheel',
        'tank_capacity',
        'fuel_type',
        'fuel_economy',
        'battery_capacity',
        'top_speed',
        'acceleration',
        'seating_capacity',
        'is_auto_drive',
        'plate_number',
        'driving_mode',
        'manufactured_at',
        'description',
        'price',
        'number_of_cylinders',
        'engine_capacity',
        'gearbox_speeds',
    */




    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'color' => $this->faker->hexColor(),
            'is_four_wheel' => $this->faker->boolean(),
            'tank_capacity' => $this->faker->numberBetween(30, 100),
            'fuel_type' => $this->faker->randomElement(['Petrol', 'Diesel']),
            'top_speed' => $this->faker->numberBetween(40, 500),
            'battery_capacity' => $this->faker->numberBetween(12, 15),
            'acceleration' => $this->faker->numberBetween(1, 10),
            'seating_capacity' => $this->faker->numberBetween(1, 12),
            'driving_mode' => $this->faker->randomElement(['auto', 'manual']),
            'is_auto_drive' => $this->faker->boolean(),
            'plate_number' => $this->faker->creditCardNumber(),
            'manufactured_at' => $this->faker->date(),
            'fuel_economy' => $this->faker->numberBetween(1, 7),
            'price' => $this->faker->numberBetween(2500, 30000000),
            'number_of_cylinders' => $this->faker->numberBetween(3, 16),
            'engine_capacity' => $this->faker->numberBetween(3, 7),
            'gearbox_speeds' => $this->faker->numberBetween(1, 9),
            'description' => $this->faker->realText(300),
        ];
    }
}
