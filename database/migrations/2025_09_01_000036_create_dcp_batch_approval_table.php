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
        Schema::create('dcp_batch_approval', function (Blueprint $table) {
            $table->integer('dcp_batch_approval_id')->autoIncrement();
            $table->integer('dcp_batches_id');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', ''])->default('Pending');
            $table->timestamp('submitted_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('dcp_batches_id', 'fk_dcp_batches_id');
            $table->foreign('dcp_batches_id', 'fk_dcp_batches_id')
                ->references('pk_dcp_batches_id')
                ->on('dcp_batches')
                ->onDelete('no action')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_batch_approval');
    }
};
