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
        Schema::table('school_equipment', function (Blueprint $table) {
            $table->integer('dcp_batch_id')->nullable()->after('old_property_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_equipment', function (Blueprint $table) {
            //
        });
    }
};
