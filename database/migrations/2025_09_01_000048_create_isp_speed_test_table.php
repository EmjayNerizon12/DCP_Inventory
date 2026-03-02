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
        Schema::create('isp_speed_test', function (Blueprint $table) {
            $table->integer('pk_isp_speed_test_id')->autoIncrement();
            $table->integer('isp_details_id');
            $table->string('download', 100);
            $table->string('upload', 100);
            $table->string('ping', 100);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('isp_details_id', 'fk_isp_details_id');
            $table->foreign('isp_details_id', 'fk_isp_details_id')
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
        Schema::dropIfExists('isp_speed_test');
    }
};
