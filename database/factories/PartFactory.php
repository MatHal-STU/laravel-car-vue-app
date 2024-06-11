<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Part;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'serialnumber' => $this->faker->unique()->bothify('???###'),
            'car_id' => Car::factory(),
        ];
    }
}
