<?php

use App\Http\Controllers\Management\Plant\PlantTypeController;
use App\Http\Controllers\Management\Plant\PlantMakeController;
use App\Http\Controllers\Management\Plant\PlantModelController;
use App\Http\Controllers\Management\Plant\PlantSerialRangeController;
use App\Http\Controllers\Management\Plant\PlantSerialNumberController;
use App\Http\Controllers\Management\Plant\PlantConfigurationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::prefix('plant-management')->name('plant-management.')->group(function () {
        
        // Plant Types
        Route::get('/', [PlantTypeController::class, 'index'])->name('index');
        Route::post('/types', [PlantTypeController::class, 'store'])->name('types.store');
        Route::put('/types/{plantType}', [PlantTypeController::class, 'update'])->name('types.update');
        Route::delete('/types/{plantType}', [PlantTypeController::class, 'destroy'])->name('types.destroy');
        
        // Plant Makes
        Route::post('/makes', [PlantMakeController::class, 'store'])->name('makes.store');
        Route::put('/makes/{plantMake}', [PlantMakeController::class, 'update'])->name('makes.update');
        Route::delete('/makes/{plantMake}', [PlantMakeController::class, 'destroy'])->name('makes.destroy');

        // Plant Models
        Route::post('/models', [PlantModelController::class, 'store'])->name('models.store');
        Route::put('/models/{plantModel}', [PlantModelController::class, 'update'])->name('models.update');
        Route::delete('/models/{plantModel}', [PlantModelController::class, 'destroy'])->name('models.destroy');

        // Plant Serial Ranges
        Route::post('/ranges', [PlantSerialRangeController::class, 'store'])->name('ranges.store');
        Route::put('/ranges/{plantSerialRange}', [PlantSerialRangeController::class, 'update'])->name('ranges.update');
        Route::delete('/ranges/{plantSerialRange}', [PlantSerialRangeController::class, 'destroy'])->name('ranges.destroy');

        // Plant Serial Numbers
        Route::post('/serials', [PlantSerialNumberController::class, 'store'])->name('serials.store');
        Route::put('/serials/{plantSerialNumber}', [PlantSerialNumberController::class, 'update'])->name('serials.update');
        Route::delete('/serials/{plantSerialNumber}', [PlantSerialNumberController::class, 'destroy'])->name('serials.destroy');

        // Plant Configurations
        Route::post('/configurations', [PlantConfigurationController::class, 'store'])->name('plant-configurations.store');
        Route::put('/configurations/{plantConfiguration}', [PlantConfigurationController::class, 'update'])->name('plant-configurations.update');
        Route::delete('/configurations/{plantConfiguration}', [PlantConfigurationController::class, 'destroy'])->name('plant-configurations.destroy');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
