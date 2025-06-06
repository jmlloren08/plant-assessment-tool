<?php

namespace Database\Seeders;

use App\Models\PlantModel;
use App\Models\PlantSerialRange;
use Illuminate\Database\Seeder;

class PlantSerialRangeSeeder extends Seeder
{
    public function run(): void
    {
        $modelIds = [
            'D6T' => PlantModel::where('name', 'D6T')->first()->id,
            'D85EX' => PlantModel::where('name', 'D85EX')->first()->id,
            'EC480E' => PlantModel::where('name', 'EC480E')->first()->id,
            'ZX350LC' => PlantModel::where('name', 'ZX350LC')->first()->id,
            '950GC' => PlantModel::where('name', '950GC')->first()->id,
            '426ZX' => PlantModel::where('name', '426ZX')->first()->id,
            '140K' => PlantModel::where('name', '140K')->first()->id,
            'GD675-6' => PlantModel::where('name', 'GD675-6')->first()->id,
            'A40G' => PlantModel::where('name', 'A40G')->first()->id,
            'T284' => PlantModel::where('name', 'T284')->first()->id,
            'LTM 1100' => PlantModel::where('name', 'LTM 1100')->first()->id,
            'SCX2000' => PlantModel::where('name', 'SCX2000')->first()->id,
            'JS220LC' => PlantModel::where('name', 'JS220LC')->first()->id,
            'L120H' => PlantModel::where('name', 'L120H')->first()->id,
            'GD675-6' => PlantModel::where('name', 'GD675-6')->first()->id,
            'D8T' => PlantModel::where('name', 'D8T')->first()->id,
            'GMK4100' => PlantModel::where('name', 'GMK4100')->first()->id,
            'HD785-7' => PlantModel::where('name', 'HD785-7')->first()->id,
            'ZW370-6' => PlantModel::where('name', 'ZW370-6')->first()->id,
            'R980 SME' => PlantModel::where('name', 'R980 SME')->first()->id,
        ];

        $ranges = [
            ['prefix' => 'KJL', 'model_id' => $modelIds['D6T']],
            ['prefix' => 'KMT', 'model_id' => $modelIds['D85EX']],
            ['prefix' => 'VEC', 'model_id' => $modelIds['EC480E']],
            ['prefix' => 'HZX', 'model_id' => $modelIds['ZX350LC']],
            ['prefix' => 'CAT', 'model_id' => $modelIds['950GC']],
            ['prefix' => 'JCB', 'model_id' => $modelIds['426ZX']],
            ['prefix' => 'CKG', 'model_id' => $modelIds['140K']],
            ['prefix' => 'KMGR', 'model_id' => $modelIds['GD675-6']],
            ['prefix' => 'VTRK', 'model_id' => $modelIds['A40G']],
            ['prefix' => 'LTRK', 'model_id' => $modelIds['T284']],
            ['prefix' => 'CRN', 'model_id' => $modelIds['LTM 1100']],
            ['prefix' => 'HCR', 'model_id' => $modelIds['SCX2000']],
            ['prefix' => 'JCBEX', 'model_id' => $modelIds['JS220LC']],
            ['prefix' => 'VLD', 'model_id' => $modelIds['L120H']],
            ['prefix' => 'KMG', 'model_id' => $modelIds['GD675-6']],
            ['prefix' => 'CATDZ', 'model_id' => $modelIds['D8T']],
            ['prefix' => 'GRV', 'model_id' => $modelIds['GMK4100']],
            ['prefix' => 'KTRK', 'model_id' => $modelIds['HD785-7']],
            ['prefix' => 'HLD', 'model_id' => $modelIds['ZW370-6']],
            ['prefix' => 'LEX', 'model_id' => $modelIds['R980 SME']],
        ];

        foreach ($ranges as $range) {
            PlantSerialRange::create($range);
        }
    }
}
