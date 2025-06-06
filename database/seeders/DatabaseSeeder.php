<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlantTypeSeeder::class,
            PlantMakeSeeder::class,
            PlantModelSeeder::class,
            PlantConfigurationSeeder::class,
            PlantSerialRangeSeeder::class,
            PlantSerialNumberSeeder::class,
        ]);
    }
}
