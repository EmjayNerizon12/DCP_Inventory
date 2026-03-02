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
        Schema::create('isp_details', function (Blueprint $table) {
            $table->integer('pk_isp_details_id')->autoIncrement();
            $table->integer('school_id');
            $table->integer('isp_list_id');
            $table->integer('isp_purpose_id')->nullable();
            $table->integer('isp_connection_type_id');
            $table->integer('isp_internet_quality_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('school_id', 'fk_school_id');
            $table->index('isp_connection_type_id', 'fk_isp_connection_type_id');
            $table->index('isp_internet_quality_id', 'fk_internet_quality_id');
            $table->index('isp_list_id', 'fk_list_Id');
            $table->index('isp_purpose_id', 'fk_isp_purpose_id');
            $table->foreign('isp_internet_quality_id', 'fk_internet_quality_id')
                ->references('pk_isp_internet_quality_id')
                ->on('isp_internet_quality')
                ;
            $table->foreign('isp_connection_type_id', 'fk_isp_connection_type_id')
                ->references('pk_isp_connection_type_id')
                ->on('isp_connection_type')
                ;
            $table->foreign('isp_purpose_id', 'fk_isp_purpose_id')
                ->references('pk_isp_purpose_id')
                ->on('isp_purpose')
                ;
            $table->foreign('isp_list_id', 'fk_list_Id')
                ->references('pk_isp_list_id')
                ->on('isp_list')
                ;
            $table->foreign('school_id', 'fk_school_id')
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
        Schema::dropIfExists('isp_details');
    }
};
