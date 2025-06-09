<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\Company;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all()->keyBy('name');
        
        $industries = [
            [
                'name' => 'Iron Ore Mining',
                'description' => 'Mining and processing of iron ore',
                'company_id' => $companies['BHP']->id,
            ],
            [
                'name' => 'Copper Mining',
                'description' => 'Mining and processing of copper ore',
                'company_id' => $companies['BHP']->id,
            ],
            [
                'name' => 'Gold Mining',
                'description' => 'Mining and processing of gold ore',
                'company_id' => $companies['Newcrest Mining']->id,
            ],
            [
                'name' => 'Coal Mining',
                'description' => 'Mining and processing of coal',
                'company_id' => $companies['South32']->id,
            ],
            [
                'name' => 'Bauxite Mining',
                'description' => 'Mining and processing of bauxite',
                'company_id' => $companies['Rio Tinto']->id,
            ],
            [
                'name' => 'Iron Ore Processing',
                'description' => 'Processing and export of iron ore',
                'company_id' => $companies['Fortescue Metals Group']->id,
            ],
        ];

        foreach ($industries as $industry) {
            Industry::create($industry);
        }
    }
}
