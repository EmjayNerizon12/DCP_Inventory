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
        Schema::create('dcp_package_content', function (Blueprint $table) {
            $table->integer('pk_dcp_package_content_id')->autoIncrement();
            $table->integer('dcp_package_types_id');
            $table->integer('dcp_item_types_id');
            $table->integer('dcp_batch_item_brands_id')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('dcp_item_types_id', 'dcp_item_types_id');
            $table->index('dcp_package_types_id', 'dcp_package_types_id');
            $table->index('dcp_batch_item_brands_id', 'fk_dcp_batch_item_brands_id');
            $table->foreign('dcp_item_types_id', 'dcp_package_content_ibfk_1')
                ->references('pk_dcp_item_types_id')
                ->on('dcp_item_types')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ;
            $table->foreign('dcp_package_types_id', 'dcp_package_content_ibfk_2')
                ->references('pk_dcp_package_types_id')
                ->on('dcp_package_types')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ;
            $table->foreign('dcp_batch_item_brands_id', 'fk_dcp_batch_item_brands_id')
                ->references('pk_dcp_batch_item_brands_id')
                ->on('dcp_batch_item_brands')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcp_package_content');
    }
};
