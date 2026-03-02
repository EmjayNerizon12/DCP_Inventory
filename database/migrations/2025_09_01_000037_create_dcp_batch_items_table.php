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
        Schema::create('dcp_batch_items', function (Blueprint $table) {
            $table->integer('pk_dcp_batch_items_id')->autoIncrement();
            $table->integer('dcp_batch_id');
            $table->integer('item_type_id');
            $table->string('generated_code', 100)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit', 50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->enum('item_status', ['0', '1'])->nullable()->default('1')->comment('0 not functional, 1 functional');
            $table->enum('iar_value', ['with IAR', 'without IAR'])->nullable();
            $table->string('iar_ref_code', 100)->nullable();
            $table->string('iar_file', 255)->nullable();
            $table->date('iar_date')->nullable();
            $table->enum('itr_value', ['with ITR', 'without ITR'])->nullable();
            $table->string('itr_ref_code', 100)->nullable();
            $table->string('itr_file', 255)->nullable();
            $table->date('itr_date')->nullable();
            $table->string('coc_status', 100)->nullable();
            $table->string('certificate_of_completion', 255)->nullable();
            $table->string('training_acceptance_status', 255)->nullable();
            $table->string('training_acceptance_file', 255)->nullable();
            $table->string('delivery_receipt_status', 255)->nullable();
            $table->string('delivery_receipt_file', 255)->nullable();
            $table->string('invoice_receipt_status', 255)->nullable();
            $table->string('invoice_receipt_file', 255)->nullable();
            $table->date('date_approved')->nullable();
            $table->integer('monitored')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->unique('generated_code', 'generated_code');
            $table->unique(['generated_code', 'serial_number'], 'generated_code_2');
            $table->unique('serial_number', 'serial_number');
            $table->index('dcp_batch_id', 'dcp_batch_id');
            $table->index('item_type_id', 'item_type_id');
            $table->foreign('dcp_batch_id', 'dcp_batch_items_ibfk_1')
                ->references('pk_dcp_batches_id')
                ->on('dcp_batches')
                ->onDelete('cascade')
                ;
            $table->foreign('item_type_id', 'dcp_batch_items_ibfk_2')
                ->references('pk_dcp_item_types_id')
                ->on('dcp_item_types')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_batch_items');
    }
};
