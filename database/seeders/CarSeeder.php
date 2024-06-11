<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Part;

class CarSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'name' => 'Toyota Corolla',
                'registration_number' => 'ABC123',
                'is_registered' => true,
            ],
            [
                'name' => 'Honda Civic',
                'registration_number' => null,
                'is_registered' => false,
            ],
            [
                'name' => 'VV CC',
                'registration_number' => 'XYZ789',
                'is_registered' => true,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
