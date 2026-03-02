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
        Schema::create('dcp_batches', function (Blueprint $table) {
            $table->integer('pk_dcp_batches_id')->autoIncrement();
            $table->integer('dcp_package_type_id')->nullable();
            $table->integer('school_id')->nullable();
            $table->string('batch_label', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('email', 255)->nullable();
            $table->year('budget_year')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('supplier_name', 100)->nullable();
            $table->string('mode_of_delivery', 100)->nullable();
            $table->enum('submission_status', ['APPROVED', 'FOR EDITING', 'FOR UPDATING'])->nullable()->default('FOR EDITING');
            $table->date('date_approved')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_package_type_id', 'dcp_package_type_id');
            $table->index('school_id', 'school_id');
            $table->foreign('dcp_package_type_id', 'dcp_batches_ibfk_1')
                ->references('pk_dcp_package_types_id')
                ->on('dcp_package_types')
                ;
            $table->foreign('school_id', 'dcp_batches_ibfk_2')
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
        Schema::dropIfExists('dcp_batches');
    }
};
