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

class PlantModelController extends Controller
{
    public function index()
    {
        // return Inertia::render('plant-management', [
        //     'plantTypes' => PlantType::latest()->get(),
        //     'plantMakes' => PlantMake::latest()->get(),
        //     'plantModels' => PlantModel::with('make')->latest()->get(),
        //     'initialTab' => 'models'
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'plant_make_id' => ['required', 'exists:tbl_plant_makes,id'],
        ]);

        // Convert plant_make_id to make_id for database
        $validated['make_id'] = $validated['plant_make_id'];
        unset($validated['plant_make_id']);

        PlantModel::create($validated);

        return back()->with('success', 'Plant model created successfully.');
    }
    
    public function update(Request $request, PlantModel $plantModel)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_plant_models')->where(function ($query) use ($plantModel) {
                    return $query->where('make_id', $plantModel->make_id)
                        ->where('id', '!=', $plantModel->id);
                })
            ],
            'description' => ['nullable', 'string'],
            'plant_make_id' => ['required', 'exists:tbl_plant_makes,id'],
        ]);

        // Convert plant_make_id to make_id for database
        $validated['make_id'] = $validated['plant_make_id'];
        unset($validated['plant_make_id']);

        $updated = $plantModel->update($validated);

        return back()->with('success', 'Plant model updated successfully.');
    }

    public function destroy(PlantModel $plantModel)
    {
        $plantModel->delete();

        return back()->with('success', 'Plant model deleted successfully.');
    }
} 