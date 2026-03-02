<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_equipment_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_equipment_id');
            $table->unsignedBigInteger('document_type_id');
            $table->string('document_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_equipment_documents');
    }
};
