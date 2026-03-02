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
        Schema::create('school_grade_data', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('pk_school_id');
            $table->string('GradeLevelID', 50);
            $table->integer('RegisteredLearners')->nullable()->default(0);
            $table->integer('Teachers')->nullable()->default(0);
            $table->integer('Sections')->nullable()->default(0);
            $table->integer('Classrooms')->nullable()->default(0);
            $table->integer('NonTeachingPersonnel')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('pk_school_id', 'pk_school_id');
            $table->index('GradeLevelID', 'fk_grade_level');
            $table->foreign('GradeLevelID', 'fk_grade_level')
                ->references('GradeLevelID')
                ->on('school_grade_levels')
                ->onDelete('cascade')
                ;
            $table->foreign('pk_school_id', 'school_grade_data_ibfk_1')
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
        Schema::dropIfExists('school_grade_data');
    }
};
