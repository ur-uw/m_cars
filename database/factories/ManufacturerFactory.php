<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManufacturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Manufacturer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brands = [
            'Mazda',
            'BMW',
            'Subaru',
            'Porsche',
            'Lexus',
            'Toyota',
            'Chrysler',
            'Buick',
            'Hyundai',
            'Audi',
            'Infiniti',
            'Nissan',
            'Dodge',
            'Genesis',
            'Tesla',
            'Mini',
            'Volkswagen',
            'Kia',
            'Volvo',
            'Mercedes-Benz',
            'Cadillac',
            'Acura',
        ];
        return [
            'name' => $this->faker->unique->randomElement($brands),
            'country' => $this->faker->country(),
        ];
    }
}
