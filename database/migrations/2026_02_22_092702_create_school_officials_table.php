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
        Schema::dropIfExists('school_officials');
        Schema::create('school_officials', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');

            $table->foreign('school_id')
                ->references('pk_school_id')
                ->on('schools')
                ->cascadeOnDelete();

            $table->integer('school_head')->nullable();
            $table->integer('ict_coordinator')->nullable();
            $table->integer('property_custodian')->nullable();

            $table->foreign('school_head')
                ->references('pk_schools_employee_id')
                ->on('schools_employee')
                ->nullOnDelete();

            $table->foreign('ict_coordinator')
                ->references('pk_schools_employee_id')
                ->on('schools_employee')
                ->nullOnDelete();

            $table->foreign('property_custodian')
                ->references('pk_schools_employee_id')
                ->on('schools_employee')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_officials');
    }
};
