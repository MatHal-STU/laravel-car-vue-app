<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Part;
use App\Models\Car;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parts = [
            [
                'name' => 'Engine',
                'serialnumber' => 'ENG123',
                'car_id' => 1, // Assuming car ID 1 exists
            ],
            [
                'name' => 'Transmission',
                'serialnumber' => 'TRN456',
                'car_id' => 1, // Assuming car ID 1 exists
            ],
            [
                'name' => 'Battery',
                'serialnumber' => 'BAT789',
                'car_id' => 2, // Assuming car ID 2 exists
            ],
            // Add more parts as needed
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}
