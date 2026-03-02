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
        Schema::create('school_equipment_accountabilties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_type_id');
            $table->unsignedBigInteger('school_equipment_id');

            // ACCOUNTABLE EMPLOYEE - SELECT FROM EMPLOYEE TABLE
            $table->integer('accountable_employee_id')->nullable();
            $table->date('date_assigned_to_accountable_employee')->nullable();

            // ENCODING NAME FOR END USER
            // $table->unsignedBigInteger('end_user_id')->nullable();
            // $table->date('date_assigned_to_end_user')->nullable();

            // for actual equipment handover
            $table->unsignedBigInteger('receiver_type_id')->nullable();
            $table->date('date_received')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_equipment_accountabilties');
    }
};
