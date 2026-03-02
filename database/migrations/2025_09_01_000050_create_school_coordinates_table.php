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
        Schema::create('school_coordinates', function (Blueprint $table) {
            $table->integer('CoordID')->autoIncrement();
            $table->integer('pk_school_id')->nullable();
            $table->decimal('Latitude', 10, 6)->nullable();
            $table->decimal('Longitude', 10, 6)->nullable();
            $table->integer('is_considered_remote')->nullable();
            $table->string('uacs', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('pk_school_id', 'pk_school_id');
            $table->foreign('pk_school_id', 'school_coordinates_ibfk_1')
                ->references('pk_school_id')
                ->on('schools')
                ->onDelete('cascade')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_coordinates');
    }
};
