<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_plant_areas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('serial_range_id')->nullable();
            // $table->uuid('plant_type_id')->nullable();
            // $table->uuid('ignition_id')->nullable();
            // $table->uuid('fuel_id')->nullable();
            // $table->uuid('oxygen_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_plant_areas');
    }
};
