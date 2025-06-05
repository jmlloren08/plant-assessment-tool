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
        Schema::create('tbl_company_sites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('company_id')->nullable();
            // $table->uuid('industry_id')->nullable();
            // $table->uuid('mine_type_id')->nullable();
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
        Schema::dropIfExists('tbl_company_sites');
    }
};
