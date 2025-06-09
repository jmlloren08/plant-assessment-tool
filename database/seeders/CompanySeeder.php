<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'BHP',
                'description' => 'One of the world\'s largest mining companies',
                'address' => '171 Collins Street, Melbourne VIC 3000, Australia',
            ],
            [
                'name' => 'Rio Tinto',
                'description' => 'Global mining and metals company',
                'address' => 'Level 7, 360 Collins Street, Melbourne VIC 3000, Australia',
            ],
            [
                'name' => 'Fortescue Metals Group',
                'description' => 'World leader in iron ore production',
                'address' => 'Level 2, 87 Adelaide Terrace, East Perth WA 6004, Australia',
            ],
            [
                'name' => 'Newcrest Mining',
                'description' => 'One of the world\'s largest gold mining companies',
                'address' => 'Level 8, 600 St Kilda Road, Melbourne VIC 3004, Australia',
            ],
            [
                'name' => 'South32',
                'description' => 'Diversified metals and mining company',
                'address' => '108 St Georges Terrace, Perth WA 6000, Australia',
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
