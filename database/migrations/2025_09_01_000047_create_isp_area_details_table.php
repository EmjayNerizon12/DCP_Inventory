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
        Schema::create('isp_area_details', function (Blueprint $table) {
            $table->integer('pk_isp_area_details_id')->autoIncrement();
            $table->integer('isp_details_id');
            $table->integer('isp_area_available_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('isp_area_available_id', 'fk_isp_area_available_id');
            $table->index('isp_details_id', 'fk_isp_list_details_id');
            $table->foreign('isp_area_available_id', 'fk_isp_area_available_id')
                ->references('pk_isp_area_available_id')
                ->on('isp_area_available')
                ;
            $table->foreign('isp_details_id', 'fk_isp_list_details_id')
                ->references('pk_isp_details_id')
                ->on('isp_details')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isp_area_details');
    }
};
