<?php

namespace App\Http\Controllers\Management\Plant;

use App\Http\Controllers\Controller;
use App\Models\PlantMake;
use App\Models\PlantModel;
use App\Models\PlantSerialNumber;
use App\Models\PlantSerialRange;
use App\Models\PlantType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlantSerialNumberController extends Controller
{
    public function index()
    {
        // return Inertia::render('plant-management', [
        //     'plantTypes' => PlantType::orderBy('name', 'asc')->get(),
        //     'plantMakes' => PlantMake::orderBy('name', 'asc')->get(),
        //     'plantModels' => PlantModel::with('make')->orderBy('name', 'asc')->get(),
        //     'plantSerialRanges' => PlantSerialRange::with(['model.make'])->orderBy('prefix', 'asc')->get(),
        //     'plantSerialNumbers' => PlantSerialNumber::with(['serialRange.model.make'])->orderBy('serial_number', 'asc')->get(),
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'serial_range_id' => 'required|exists:tbl_plant_serial_ranges,id',
            'serial_number' => 'required|string|unique:tbl_plant_serial_numbers,serial_number',
            'description' => 'nullable|string',
        ]);

        PlantSerialNumber::create($validated);

        return redirect()->back();
    }

    public function update(Request $request, PlantSerialNumber $plantSerialNumber)
    {
        $validated = $request->validate([
            'serial_range_id' => 'required|exists:tbl_plant_serial_ranges,id',
            'serial_number' => 'required|string|unique:tbl_plant_serial_numbers,serial_number,' . $plantSerialNumber->id,
            'description' => 'nullable|string',
        ]);

        $plantSerialNumber->update($validated);

        return redirect()->back();
    }

    public function destroy(PlantSerialNumber $plantSerialNumber)
    {
        $plantSerialNumber->delete();

        return redirect()->back();
    }
} 