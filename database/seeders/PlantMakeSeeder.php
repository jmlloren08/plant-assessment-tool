<?php

namespace Database\Seeders;

use App\Models\PlantMake;
use Illuminate\Database\Seeder;

class PlantMakeSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            ['name' => 'CATERPILLAR'],
            ['name' => 'KOMATSU'],
            ['name' => 'VOLVO'],
            ['name' => 'HITACHI'],
            ['name' => 'JCB'],
            ['name' => 'LIEBHERR'],
            ['name' => 'GROVE'],
        ];

        foreach ($makes as $make) {
            PlantMake::create($make);
        }
    }
}
