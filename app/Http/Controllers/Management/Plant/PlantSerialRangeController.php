<?php

namespace App\Http\Controllers\Management\Plant;

use App\Http\Controllers\Controller;
use App\Models\PlantSerialRange;
use Illuminate\Http\Request;

class PlantSerialRangeController extends Controller
{
    public function index()
    {
        // return Inertia::render('plant-management', [
        //     'plantTypes' => PlantType::orderBy('name', 'asc')->get(),
        //     'plantMakes' => PlantMake::orderBy('name', 'asc')->get(),
        //     'plantModels' => PlantModel::with('make')
        //         ->join('tbl_plant_makes', 'tbl_plant_models.make_id', '=', 'tbl_plant_makes.id')
        //         ->orderBy('tbl_plant_makes.name', 'asc')
        //         ->select('tbl_plant_models.*')
        //         ->get(),
        //     'plantSerialRanges' => PlantSerialRange::with(['model.make'])
        //         ->join('tbl_plant_models', 'tbl_plant_serial_ranges.model_id', '=', 'tbl_plant_models.id')
        //         ->join('tbl_plant_makes', 'tbl_plant_models.make_id', '=', 'tbl_plant_makes.id')
        //         ->orderBy('tbl_plant_makes.name', 'asc')
        //         ->orderBy('tbl_plant_models.name', 'asc')
        //         ->select('tbl_plant_serial_ranges.*')
        //         ->get(),
        //     'initialTab' => 'ranges'
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prefix' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'model_id' => ['required', 'exists:tbl_plant_models,id'],
        ]);

        PlantSerialRange::create($validated);

        return back()->with('success', 'Serial range created successfully.');
    }
    
    public function update(Request $request, PlantSerialRange $plantSerialRange)
    {
        $validated = $request->validate([
            'prefix' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'model_id' => ['required', 'exists:tbl_plant_models,id'],
        ]);

        $plantSerialRange->update($validated);

        return back()->with('success', 'Serial range updated successfully.');
    }

    public function destroy(PlantSerialRange $plantSerialRange)
    {
        $plantSerialRange->delete();

        return back()->with('success', 'Serial range deleted successfully.');
    }
} 