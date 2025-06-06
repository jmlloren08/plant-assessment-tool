<?php

namespace Database\Seeders;

use App\Models\PlantSerialNumber;
use App\Models\PlantSerialRange;
use Illuminate\Database\Seeder;

class PlantSerialNumberSeeder extends Seeder
{
    public function run(): void
    {
        $ranges = [
            'KJL' => PlantSerialRange::where('prefix', 'KJL')->first()->id,
            'KMT' => PlantSerialRange::where('prefix', 'KMT')->first()->id,
            'VEC' => PlantSerialRange::where('prefix', 'VEC')->first()->id,
            'HZX' => PlantSerialRange::where('prefix', 'HZX')->first()->id,
            'CAT' => PlantSerialRange::where('prefix', 'CAT')->first()->id,
            'JCB' => PlantSerialRange::where('prefix', 'JCB')->first()->id,
            'CKG' => PlantSerialRange::where('prefix', 'CKG')->first()->id,
            'KMGR' => PlantSerialRange::where('prefix', 'KMGR')->first()->id,
            'VTRK' => PlantSerialRange::where('prefix', 'VTRK')->first()->id,
            'LTRK' => PlantSerialRange::where('prefix', 'LTRK')->first()->id,
            'CRN' => PlantSerialRange::where('prefix', 'CRN')->first()->id,
            'HCR' => PlantSerialRange::where('prefix', 'HCR')->first()->id,
            'JCBEX' => PlantSerialRange::where('prefix', 'JCBEX')->first()->id,
            'VLD' => PlantSerialRange::where('prefix', 'VLD')->first()->id,
            'KMG' => PlantSerialRange::where('prefix', 'KMG')->first()->id,
            'CATDZ' => PlantSerialRange::where('prefix', 'CATDZ')->first()->id,
            'GRV' => PlantSerialRange::where('prefix', 'GRV')->first()->id,
            'KTRK' => PlantSerialRange::where('prefix', 'KTRK')->first()->id,
            'HLD' => PlantSerialRange::where('prefix', 'HLD')->first()->id,
            'LEX' => PlantSerialRange::where('prefix', 'LEX')->first()->id,
        ];

        $serialNumbers = [
            ['serial_number' => 'KJL00321', 'serial_range_id' => $ranges['KJL']],
            ['serial_number' => 'KMT00876', 'serial_range_id' => $ranges['KMT']],
            ['serial_number' => 'VEC01456', 'serial_range_id' => $ranges['VEC']],
            ['serial_number' => 'HTZ02231', 'serial_range_id' => $ranges['HZX']],
            ['serial_number' => 'CAT09345', 'serial_range_id' => $ranges['CAT']],
            ['serial_number' => 'JCB00112', 'serial_range_id' => $ranges['JCB']],
            ['serial_number' => 'CKG07781', 'serial_range_id' => $ranges['CKG']],
            ['serial_number' => 'KMGR33445', 'serial_range_id' => $ranges['KMGR']],
            ['serial_number' => 'VTRK55601', 'serial_range_id' => $ranges['VTRK']],
            ['serial_number' => 'LTRK99021', 'serial_range_id' => $ranges['LTRK']],
            ['serial_number' => 'CRN88812', 'serial_range_id' => $ranges['CRN']],
            ['serial_number' => 'HCR00378', 'serial_range_id' => $ranges['HCR']],
            ['serial_number' => 'JCBEX0452', 'serial_range_id' => $ranges['JCBEX']],
            ['serial_number' => 'VLD07634', 'serial_range_id' => $ranges['VLD']],
            ['serial_number' => 'KMG12456', 'serial_range_id' => $ranges['KMG']],
            ['serial_number' => 'CATDZ2021', 'serial_range_id' => $ranges['CATDZ']],
            ['serial_number' => 'GRV07001', 'serial_range_id' => $ranges['GRV']],
            ['serial_number' => 'KTRK88341', 'serial_range_id' => $ranges['KTRK']],
            ['serial_number' => 'HLD06412', 'serial_range_id' => $ranges['HLD']],
            ['serial_number' => 'LEX90321', 'serial_range_id' => $ranges['LEX']],
        ];

        foreach ($serialNumbers as $serial) {
            PlantSerialNumber::create($serial);
        }
    }
}
