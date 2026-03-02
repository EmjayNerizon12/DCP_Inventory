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
        Schema::create('non_dcp_item', function (Blueprint $table) {
            $table->integer('pk_non_dcp_item_id')->autoIncrement();
            $table->integer('school_id')->nullable();
            $table->text('item_description')->nullable();
            $table->integer('total_item')->nullable();
            $table->integer('total_functional')->nullable();
            $table->decimal('unit_price', 10, 0)->nullable();
            $table->date('date_acquired');
            $table->integer('fund_source_id')->nullable();
            $table->text('item_holder_and_location')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('fund_source_id', 'fk_fund_source_id');
            $table->index('school_id', 'fk_school_id_for_non_dcp');
            $table->foreign('fund_source_id', 'fk_fund_source_id')
                ->references('pk_fund_source_id')
                ->on('fund_source')
                ;
            $table->foreign('school_id', 'fk_school_id_for_non_dcp')
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
        Schema::dropIfExists('non_dcp_item');
    }
};
