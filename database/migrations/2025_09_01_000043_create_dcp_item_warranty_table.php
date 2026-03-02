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
        Schema::create('dcp_item_warranty', function (Blueprint $table) {
            $table->integer('pk_dcp_item_warranty_id')->autoIncrement();
            $table->integer('dcp_batch_item_id');
            $table->date('warranty_start_date')->nullable();
            $table->date('warranty_end_date')->nullable();
            $table->string('warranty_contract', 50)->nullable();
            $table->string('warranty_remaining', 100)->nullable();
            $table->integer('warranty_status_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_batch_item_id', 'dcp_batch_item_id');
            $table->index('warranty_status_id', 'warranty_status_id');
            $table->foreign('dcp_batch_item_id', 'dcp_item_warranty_ibfk_1')
                ->references('pk_dcp_batch_items_id')
                ->on('dcp_batch_items')
                ->onDelete('cascade')
                ;
            $table->foreign('warranty_status_id', 'dcp_item_warranty_ibfk_2')
                ->references('pk_dcp_warranty_statuses_id')
                ->on('dcp_warranty_statuses')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_item_warranty');
    }
};
