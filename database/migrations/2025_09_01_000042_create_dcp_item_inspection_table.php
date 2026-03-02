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
        Schema::create('dcp_item_inspection', function (Blueprint $table) {
            $table->integer('pk_dcp_item_inspection_id')->autoIncrement();
            $table->integer('dcp_batch_item_id');
            $table->date('last_inspection_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_batch_item_id', 'dcp_batch_item_id');
            $table->foreign('dcp_batch_item_id', 'dcp_item_inspection_ibfk_1')
                ->references('pk_dcp_batch_items_id')
                ->on('dcp_batch_items')
                ->onDelete('cascade')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_item_inspection');
    }
};
