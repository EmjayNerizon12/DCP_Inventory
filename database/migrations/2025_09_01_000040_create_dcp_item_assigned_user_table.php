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
        Schema::create('dcp_item_assigned_user', function (Blueprint $table) {
            $table->integer('pk_dcp_item_assigned_user_id')->autoIncrement();
            $table->integer('dcp_batch_item_id');
            $table->integer('assignment_type_id')->nullable();
            $table->string('assigned_user_name', 100)->nullable();
            $table->date('date_assigned')->nullable();
            $table->date('date_returned')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_batch_item_id', 'dcp_batch_item_id');
            $table->index('assignment_type_id', 'assignment_type_id');
            $table->index('assigned_user_name', 'assigned_user_id');
            $table->foreign('dcp_batch_item_id', 'dcp_item_assigned_user_ibfk_1')
                ->references('pk_dcp_batch_items_id')
                ->on('dcp_batch_items')
                ->onDelete('cascade')
                ;
            $table->foreign('assignment_type_id', 'dcp_item_assigned_user_ibfk_2')
                ->references('pk_dcp_assignment_types_id')
                ->on('dcp_assignment_types')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_item_assigned_user');
    }
};
