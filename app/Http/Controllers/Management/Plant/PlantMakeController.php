<?php

namespace App\Http\Controllers\Management\Plant;

use App\Http\Controllers\Controller;
use App\Models\PlantType;
use App\Models\PlantMake;
use App\Models\PlantModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class PlantMakeController extends Controller
{
    public function index()
    {
        // return Inertia::render('plant-management', [
        //     'plantTypes' => PlantType::latest()->get(),
        //     'plantMakes' => PlantMake::latest()->get(),
        //     'plantModels' => PlantModel::with('make')->latest()->get(),
        //     'initialTab' => 'makes'
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tbl_plant_makes'],
            'description' => ['nullable', 'string'],
        ]);

        PlantMake::create($validated);

        return back()->with('success', 'Plant make created successfully.');
    }

    public function update(Request $request, PlantMake $plantMake)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_plant_makes')->ignore($plantMake->id)
            ],
            'description' => ['nullable', 'string'],
        ]);

        $updated = $plantMake->update($validated);

        return back()->with('success', 'Plant make updated successfully.');
    }

    public function destroy(PlantMake $plantMake)
    {
        $plantMake->delete();

        return back()->with('success', 'Plant make deleted successfully.');
    }
} 