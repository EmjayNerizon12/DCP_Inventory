<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_biometric_details', function (Blueprint $table) {
            $table->integer('pk_e_biometric_details_id')->autoIncrement();
            $table->integer('school_id')->nullable();
            $table->integer('equipment_details_id')->nullable();
            $table->integer('e_biometric_type_id')->nullable();
            $table->integer('no_of_units')->nullable();
            $table->integer('no_of_functional')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('e_biometric_type_id', 'fk_e_biometric_type');
            $table->index('equipment_details_id', 'fk_biometric_equipment_details');
            $table->index('school_id', 'fk_school_id_biometric');
            $table->foreign('equipment_details_id', 'fk_biometric_equipment_details')
                ->references('pk_equipment_details_id')
                ->on('equipment_details')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ;
            $table->foreign('e_biometric_type_id', 'fk_e_biometric_type')
                ->references('pk_e_biometric_type_id')
                ->on('e_biometric_type')
                ;
            $table->foreign('school_id', 'fk_school_id_biometric')
                ->references('pk_school_id')
                ->on('schools')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_biometric_details');
    }
};
