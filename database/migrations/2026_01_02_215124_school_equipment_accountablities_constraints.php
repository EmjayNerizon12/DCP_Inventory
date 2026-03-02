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
        Schema::table('school_equipment_accountabilties', function (Blueprint $table) {

            // TRANSACTION TYPE
            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('school_equipment_transaction_types')
                ->restrictOnDelete();

            // SCHOOL EQUIPMENT
            $table->foreign('school_equipment_id')
                ->references('id')
                ->on('school_equipment')
                ->cascadeOnDelete();

            // ACCOUNTABLE OFFICER (EMPLOYEE)
            $table->foreign('accountable_employee_id')
                ->references('pk_schools_employee_id')
                ->on('schools_employee')
                ->nullOnDelete();

            // RECEIVED BY (EMPLOYEE)
            $table->foreign('receiver_type_id')
                ->references('id')
                ->on('school_equipment_receiver_types')
                ->nullOnDelete();
        });
        Schema::table('school_equipment_end_users', function (Blueprint $table) {
            $table->foreign('accountability_id')
                ->references('id')
                ->on('school_equipment_accountabilties')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_equipment_accountabilties', function (Blueprint $table) {

            $table->dropForeign(['transaction_type_id']);
            $table->dropForeign(['school_equipment_id']);
            $table->dropForeign(['accountable_employee_id']);
            $table->dropForeign(['receiver_type_id']);
        });
        Schema::table('school_equipment_end_users', function (Blueprint $table) {
            $table->dropForeign(['accountability_id']);
        });
    }
};
