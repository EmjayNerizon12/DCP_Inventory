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
        Schema::create('dcp_item_condition', function (Blueprint $table) {
            $table->integer('pk_dcp_item_condition_id')->autoIncrement();
            $table->integer('dcp_batch_item_id');
            $table->integer('current_condition_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_batch_item_id', 'fk_batch_item_id');
            $table->index('current_condition_id', 'fk_current_condition_id');
            $table->foreign('dcp_batch_item_id', 'fk_batch_item_id')
                ->references('pk_dcp_batch_items_id')
                ->on('dcp_batch_items')
                ;
            $table->foreign('current_condition_id', 'fk_current_condition_id')
                ->references('pk_dcp_current_conditions_id')
                ->on('dcp_current_conditions')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_item_condition');
    }
};
