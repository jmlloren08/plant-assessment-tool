<?php

namespace Database\Seeders;

use App\Models\CompanySite;
use App\Models\Company;
use App\Models\Industry;
use App\Models\MineType;
use Illuminate\Database\Seeder;

class CompanySiteSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all()->keyBy('name');
        $industries = Industry::all()->keyBy('name');
        $mineTypes = MineType::all()->keyBy('name');

        $sites = [
            [
                'name' => 'Mount Whaleback',
                'description' => 'One of the largest iron ore mines in the world',
                'company_id' => $companies['BHP']->id,
                'industry_id' => $industries['Iron Ore Mining']->id,
                'mine_type_id' => $mineTypes['Open Cut']->id,
            ],
            [
                'name' => 'Olympic Dam',
                'description' => 'Large copper and uranium mine',
                'company_id' => $companies['BHP']->id,
                'industry_id' => $industries['Copper Mining']->id,
                'mine_type_id' => $mineTypes['Underground']->id,
            ],
            [
                'name' => 'Telfer',
                'description' => 'Gold-copper mine in Western Australia',
                'company_id' => $companies['Newcrest Mining']->id,
                'industry_id' => $industries['Gold Mining']->id,
                'mine_type_id' => $mineTypes['Open Cut']->id,
            ],
            [
                'name' => 'Weipa',
                'description' => 'Major bauxite mining operation',
                'company_id' => $companies['Rio Tinto']->id,
                'industry_id' => $industries['Bauxite Mining']->id,
                'mine_type_id' => $mineTypes['Strip Mining']->id,
            ],
            [
                'name' => 'Cloudbreak',
                'description' => 'Iron ore mine in Pilbara region',
                'company_id' => $companies['Fortescue Metals Group']->id,
                'industry_id' => $industries['Iron Ore Processing']->id,
                'mine_type_id' => $mineTypes['Open Cut']->id,
            ],
            [
                'name' => 'Illawarra',
                'description' => 'Metallurgical coal operations',
                'company_id' => $companies['South32']->id,
                'industry_id' => $industries['Coal Mining']->id,
                'mine_type_id' => $mineTypes['Underground']->id,
            ],
        ];

        foreach ($sites as $site) {
            CompanySite::create($site);
        }
    }
}
