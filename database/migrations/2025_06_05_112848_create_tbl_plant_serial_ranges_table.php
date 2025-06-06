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
        Schema::create('tbl_plant_serial_ranges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('model_id')->nullable();
            // $table->uuid('plant_area_id')->nullable();
            $table->string('prefix');
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
        Schema::dropIfExists('tbl_plant_serial_ranges');
    }
};
