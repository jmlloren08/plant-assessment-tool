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
        Schema::create('tbl_plants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('plant_type_id')->nullable();
            // $table->uuid('serial_range_id')->nullable();
            // $table->uuid('configuration_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_plants');
    }
};
