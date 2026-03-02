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
        Schema::create('schools', function (Blueprint $table) {
            $table->integer('pk_school_id')->autoIncrement();
            $table->string('SchoolID', 50);
            $table->string('SchoolName', 255);
            $table->string('SchoolLevel', 100)->nullable();
            $table->string('Region', 100)->nullable();
            $table->string('Province', 100)->nullable();
            $table->string('District', 100)->nullable();
            $table->string('CityMunicipality', 100)->nullable();
            $table->string('Division', 100)->nullable();
            $table->integer('total_no_teaching')->nullable();
            $table->integer('classroom_with_tv')->nullable();
            $table->text('SchoolAddress')->nullable();
            $table->string('SchoolContactNumber', 50)->nullable();
            $table->string('SchoolContactNumber2', 50)->nullable();
            $table->string('SchoolTelNumber', 50)->nullable();
            $table->string('SchoolEmailAddress', 255)->nullable();
            $table->string('PrincipalName', 255)->nullable();
            $table->string('PrincipalContact', 50)->nullable();
            $table->string('PrincipalEmail', 255)->nullable();
            $table->string('ICTName', 255)->nullable();
            $table->string('ICTContact', 50)->nullable();
            $table->string('ICTEmail', 255)->nullable();
            $table->string('CustodianName', 255)->nullable();
            $table->string('CustodianContact', 50)->nullable();
            $table->string('CustodianEmail', 255)->nullable();
            $table->string('admin_position', 255)->nullable();
            $table->string('admin_email', 100)->nullable();
            $table->string('admin_mobile_no', 50)->nullable();
            $table->string('admin_staff_email', 100)->nullable();
            $table->string('admin_staff_mobile_no', 50)->nullable();
            $table->integer('has_network_admin')->nullable();
            $table->integer('has_bandwidth')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('SchoolLevel', 'fk_schools_gradelevel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
