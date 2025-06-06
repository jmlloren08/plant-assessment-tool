<?php

namespace Database\Seeders;

use App\Models\PlantType;
use Illuminate\Database\Seeder;

class PlantTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'DOZER'],
            ['name' => 'EXCAVATOR'],
            ['name' => 'LOADER'],
            ['name' => 'GRADER'],
            ['name' => 'TRUCK'],
            ['name' => 'CRANE'],
        ];

        foreach ($types as $type) {
            PlantType::create($type);
        }
    }
}
