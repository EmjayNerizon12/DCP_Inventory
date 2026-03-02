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
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->integer('pk_equipment_details_id')->autoIncrement();
            $table->integer('equipment_type_id')->nullable();
            $table->integer('equipment_brand_model_id')->nullable();
            $table->integer('equipment_location_id')->nullable();
            $table->integer('equipment_power_source_id')->nullable();
            $table->date('date_installed')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->integer('equipment_installer_id')->nullable();
            $table->integer('equipment_incharge_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('equipment_type_id', 'fk_equipment_type');
            $table->index('equipment_brand_model_id', 'fk_brand_model');
            $table->index('equipment_location_id', 'fk_location');
            $table->index('equipment_incharge_id', 'fk_incharge');
            $table->index('equipment_power_source_id', 'fk_power_source');
            $table->index('equipment_installer_id', 'fk_installer');
            $table->foreign('equipment_brand_model_id', 'fk_brand_model')
                ->references('pk_equipment_brand_model_id')
                ->on('equipment_brand_model')
                ;
            $table->foreign('equipment_type_id', 'fk_equipment_type')
                ->references('pk_equipment_type_id')
                ->on('equipment_type')
                ;
            $table->foreign('equipment_incharge_id', 'fk_incharge')
                ->references('pk_equipment_incharge_id')
                ->on('equipment_incharge')
                ;
            $table->foreign('equipment_installer_id', 'fk_installer')
                ->references('pk_equipment_installer_id')
                ->on('equipment_installer')
                ;
            $table->foreign('equipment_location_id', 'fk_location')
                ->references('pk_equipment_location_id')
                ->on('equipment_location')
                ;
            $table->foreign('equipment_power_source_id', 'fk_power_source')
                ->references('pk_equipment_power_source_id')
                ->on('equipment_power_source')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_details');
    }
};
