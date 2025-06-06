<?php

namespace Database\Seeders;

use App\Models\PlantMake;
use App\Models\PlantModel;
use Illuminate\Database\Seeder;

class PlantModelSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            'CATERPILLAR' => PlantMake::where('name', 'CATERPILLAR')->first()->id,
            'KOMATSU' => PlantMake::where('name', 'KOMATSU')->first()->id,
            'VOLVO' => PlantMake::where('name', 'VOLVO')->first()->id,
            'HITACHI' => PlantMake::where('name', 'HITACHI')->first()->id,
            'JCB' => PlantMake::where('name', 'JCB')->first()->id,
            'LIEBHERR' => PlantMake::where('name', 'LIEBHERR')->first()->id,
            'GROVE' => PlantMake::where('name', 'GROVE')->first()->id,
        ];
        
        $models = [
            ['name' => 'D6T', 'make_id' => $makes['CATERPILLAR']],
            ['name' => 'D8T', 'make_id' => $makes['CATERPILLAR']],
            ['name' => '140K', 'make_id' => $makes['CATERPILLAR']],
            ['name' => '950GC', 'make_id' => $makes['CATERPILLAR']],
            
            ['name' => 'D85EX', 'make_id' => $makes['KOMATSU']],
            ['name' => 'GD675-6', 'make_id' => $makes['KOMATSU']],
            ['name' => 'HD785-7', 'make_id' => $makes['KOMATSU']],
            
            ['name' => 'EC480E', 'make_id' => $makes['VOLVO']],
            ['name' => 'A40G', 'make_id' => $makes['VOLVO']],
            ['name' => 'L120H', 'make_id' => $makes['VOLVO']],
            
            ['name' => 'ZX350LC', 'make_id' => $makes['HITACHI']],
            ['name' => 'SCX2000', 'make_id' => $makes['HITACHI']],
            ['name' => 'ZW370-6', 'make_id' => $makes['HITACHI']],
            
            ['name' => 'JS220LC', 'make_id' => $makes['JCB']],
            ['name' => '426ZX', 'make_id' => $makes['JCB']],
            
            ['name' => 'T284', 'make_id' => $makes['LIEBHERR']],
            ['name' => 'LTM 1100', 'make_id' => $makes['LIEBHERR']],
            ['name' => 'R980 SME', 'make_id' => $makes['LIEBHERR']],
            
            ['name' => 'GMK4100', 'make_id' => $makes['GROVE']],
        ];

        foreach ($models as $model) {
            PlantModel::create($model);
        }
    }
}
