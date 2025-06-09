<?php

namespace Database\Seeders;

use App\Models\MineType;
use Illuminate\Database\Seeder;

class MineTypeSeeder extends Seeder
{
    public function run(): void
    {
        $mineTypes = [
            [
                'name' => 'Open Cut',
                'description' => 'Surface mining operation where minerals are extracted from an open pit',
            ],
            [
                'name' => 'Underground',
                'description' => 'Mining conducted below the surface through tunnels and shafts',
            ],
            [
                'name' => 'Strip Mining',
                'description' => 'Surface mining where mineral seams are exposed by removing overburden',
            ],
            [
                'name' => 'In-Situ Mining',
                'description' => 'Mining conducted by extracting minerals through wells while leaving rock in place',
            ],
            [
                'name' => 'Quarrying',
                'description' => 'Surface mining to extract stone, gravel, and sand',
            ],
        ];

        foreach ($mineTypes as $type) {
            MineType::create($type);
        }
    }
}
