<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\CompanySite;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $sites = CompanySite::all()->keyBy('name');        $persons = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@bhp.com',
                'phone' => '0412345678',
                'role' => 'Site Manager',
                'company_site_id' => $sites['Mount Whaleback']->id,
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@riotinto.com',
                'phone' => '0423456789',
                'role' => 'Safety Inspector',
                'company_site_id' => $sites['Weipa']->id,
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@fmgl.com.au',
                'phone' => '0434567890',
                'role' => 'Equipment Manager',
                'company_site_id' => $sites['Cloudbreak']->id,
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma.wilson@newcrest.com.au',
                'phone' => '0445678901',
                'role' => 'Operations Supervisor',
                'company_site_id' => $sites['Telfer']->id,
            ],
            [
                'name' => 'David Lee',
                'email' => 'david.lee@south32.net',
                'phone' => '0456789012',
                'role' => 'Maintenance Manager',
                'company_site_id' => $sites['Illawarra']->id,
            ],
            [
                'name' => 'Lisa Taylor',
                'email' => 'lisa.taylor@bhp.com',
                'phone' => '0467890123',
                'role' => 'Safety Coordinator',
                'company_site_id' => $sites['Olympic Dam']->id,
            ],
        ];

        foreach ($persons as $person) {
            Person::create($person);
        }
    }
}
