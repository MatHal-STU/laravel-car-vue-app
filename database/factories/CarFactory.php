<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'registration_number' => $this->faker->optional()->bothify('???###'),
            'is_registered' => $this->faker->boolean(),
        ];
    }
}
