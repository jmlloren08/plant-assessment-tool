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
        Schema::table('tbl_plant_models', function (Blueprint $table) {
            $table->foreignUuid('make_id')->references('id')->on('tbl_plant_makes');
        });

        Schema::table('tbl_plant_serial_ranges', function (Blueprint $table) {
            $table->foreignUuid('model_id')->references('id')->on('tbl_plant_models');
            // $table->foreignUuid('plant_area_id')->references('id')->on('tbl_plant_areas');
        });

        Schema::table('tbl_plant_serial_numbers', function (Blueprint $table) {
            $table->foreignUuid('serial_range_id')->references('id')->on('tbl_plant_serial_ranges');
        });

        Schema::table('tbl_plants', function (Blueprint $table) {
            $table->foreignUuid('plant_type_id')->references('id')->on('tbl_plant_types');
            $table->foreignUuid('serial_range_id')->references('id')->on('tbl_plant_serial_ranges');
            $table->foreignUuid('configuration_id')->references('id')->on('tbl_plant_configurations');
        });

        Schema::table('tbl_plant_areas', function (Blueprint $table) {
            $table->foreignUuid('serial_range_id')->references('id')->on('tbl_plant_serial_ranges');
            $table->foreignUuid('plant_type_id')->references('id')->on('tbl_plant_types');
            $table->foreignUuid('ignition_id')->references('id')->on('tbl_ignition_sources');
            $table->foreignUuid('fuel_id')->references('id')->on('tbl_fuels');
            $table->foreignUuid('oxygen_id')->references('id')->on('tbl_oxygen_sources');
        });

        Schema::table('tbl_industries', function (Blueprint $table) {
            $table->foreignUuid('company_id')->references('id')->on('tbl_companies');
        });

        Schema::table('tbl_company_sites', function (Blueprint $table) {
            $table->foreignUuid('company_id')->references('id')->on('tbl_companies');
            $table->foreignUuid('industry_id')->references('id')->on('tbl_industries');
            $table->foreignUuid('mine_type_id')->references('id')->on('tbl_mine_types');
        });

        Schema::table('tbl_persons', function (Blueprint $table) {
            $table->foreignUuid('company_site_id')->references('id')->on('tbl_company_sites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_plant_models', function (Blueprint $table) {
            $table->dropForeign(['make_id']);
        });

        Schema::table('tbl_plant_serial_ranges', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
            $table->dropForeign(['plant_area_id']);
        });

        Schema::table('tbl_plant_serial_numbers', function (Blueprint $table) {
            $table->dropForeign(['serial_range_id']);
        });

        Schema::table('tbl_plants', function (Blueprint $table) {
            $table->dropForeign(['plant_type_id']);
            $table->dropForeign(['serial_range_id']);
            $table->dropForeign(['configuration_id']);
        });

        Schema::table('tbl_plant_areas', function (Blueprint $table) {
            $table->dropForeign(['serial_range_id']);
            $table->dropForeign(['plant_type_id']);
            $table->dropForeign(['ignition_id']);
            $table->dropForeign(['fuel_id']);
            $table->dropForeign(['oxygen_id']);
        });

        Schema::table('tbl_industries', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        Schema::table('tbl_company_sites', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['industry_id']);
            $table->dropForeign(['mine_type_id']);
        });

        Schema::table('tbl_persons', function (Blueprint $table) {
            $table->dropForeign(['company_site_id']);
        });
    }
};
