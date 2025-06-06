<?php

namespace Database\Seeders;

use App\Models\PlantConfiguration;
use Illuminate\Database\Seeder;

class PlantConfigurationSeeder extends Seeder
{
    public function run(): void
    {
        $configurations = [
            ['name' => 'STANDARD'],
            ['name' => 'HEAVY DUTY'],
            ['name' => 'LITE'],
            ['name' => 'LONG REACH'],
            ['name' => 'HIGH LIFT'],
            ['name' => 'OFF-ROAD'],
            ['name' => 'HEAVY HAUL'],
            ['name' => 'TELESCOPIC'],
            ['name' => 'CRAWLER'],
            ['name' => 'ALL-TERRAIN'],
        ];

        foreach ($configurations as $config) {
            PlantConfiguration::create($config);
        }
    }
}
