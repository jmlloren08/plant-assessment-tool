<?php

namespace App\Http\Controllers\Management\Plant;

use App\Http\Controllers\Controller;
use App\Models\PlantConfiguration;
use App\Models\PlantType;
use App\Models\PlantMake;
use App\Models\PlantModel;
use App\Models\PlantSerialNumber;
use App\Models\PlantSerialRange;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class PlantTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('plant-management', [
            'plantTypes' => PlantType::orderBy('name', 'asc')->get(),
            'plantMakes' => PlantMake::orderBy('name', 'asc')->get(),
            'plantModels' => PlantModel::with('make')
                ->join('tbl_plant_makes', 'tbl_plant_models.make_id', '=', 'tbl_plant_makes.id')
                ->orderBy('tbl_plant_makes.name', 'asc')
                ->select('tbl_plant_models.*')
                ->get(),
                'plantSerialRanges' => PlantSerialRange::with(['model.make'])
                ->join('tbl_plant_models', 'tbl_plant_serial_ranges.model_id', '=', 'tbl_plant_models.id')
                ->join('tbl_plant_makes', 'tbl_plant_models.make_id', '=', 'tbl_plant_makes.id')
                ->orderBy('tbl_plant_makes.name', 'asc')
                ->orderBy('tbl_plant_models.name', 'asc')
                ->select('tbl_plant_serial_ranges.*')
                ->get(),
            'plantSerialNumbers' => PlantSerialNumber::with(['serialRange.model.make'])
                ->orderBy('serial_number', 'asc')
                ->get(),
            'plantConfigurations' => PlantConfiguration::orderBy('name', 'asc')->get(),
            'initialTab' => 'types'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tbl_plant_types'],
            'description' => ['nullable', 'string'],
        ]);

        PlantType::create($validated);

        return back()->with('success', 'Plant type created successfully.');
    }

    public function update(Request $request, PlantType $plantType)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_plant_types')->ignore($plantType->id)
            ],
            'description' => ['nullable', 'string'],
        ]);

        $updated = $plantType->update($validated);

        return back()->with('success', 'Plant type updated successfully.');
    }

    public function destroy(PlantType $plantType)
    {
        $plantType->delete();

        return back()->with('success', 'Plant type deleted successfully.');
    }
}
