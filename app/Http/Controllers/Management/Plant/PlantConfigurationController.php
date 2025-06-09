<?php

namespace App\Http\Controllers\Management\Plant;

use App\Http\Controllers\Controller;
use App\Models\PlantConfiguration;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlantConfigurationController extends Controller
{
    public function index()
    {
        // return Inertia::render('plant-management', [
        //     'plantTypes' => PlantType::orderBy('name', 'asc')->get(),
        //     'plantMakes' => PlantMake::orderBy('name', 'asc')->get(),
        //     'plantModels' => PlantModel::with('make')->orderBy('name', 'asc')->get(),
        //     'plantSerialRanges' => PlantSerialRange::with(['model.make'])->orderBy('prefix', 'asc')->get(),
        //     'plantSerialNumbers' => PlantSerialNumber::with(['serialRange.model.make'])->orderBy('serial_number', 'asc')->get(),
        //     'plantConfigurations' => PlantConfiguration::orderBy('name', 'asc')->get(),
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        PlantConfiguration::create($validated);

        return redirect()->back();
    }

    public function update(Request $request, PlantConfiguration $plantConfiguration)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $plantConfiguration->update($validated);

        return redirect()->back();
    }

    public function destroy(PlantConfiguration $plantConfiguration)
    {
        $plantConfiguration->delete();

        return redirect()->back();
    }
} 