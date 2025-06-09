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
            UserSeeder::class,
            // CompanySeeder::class,
            // IndustrySeeder::class,
            // MineTypeSeeder::class,
            // CompanySiteSeeder::class,
            // PersonSeeder::class,
            // PlantTypeSeeder::class,
            // PlantMakeSeeder::class,
            // PlantModelSeeder::class,
            // PlantConfigurationSeeder::class,
            // PlantSerialRangeSeeder::class,
            // PlantSerialNumberSeeder::class,
        ]);
    }
}
