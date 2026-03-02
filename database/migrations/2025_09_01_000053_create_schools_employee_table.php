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
        Schema::create('schools_employee', function (Blueprint $table) {
            $table->integer('pk_schools_employee_id')->autoIncrement();
            $table->string('fname', 255)->nullable();
            $table->string('lname', 255)->nullable();
            $table->string('mname', 255)->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('employee_number')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->integer('position_title_id')->nullable();
            $table->integer('salary_grade')->nullable();
            $table->integer('school_id')->nullable();
            $table->enum('sex', ['M', 'F'])->nullable();
            $table->string('deped_email', 255)->nullable();
            $table->enum('deped_email_status', ['Active', 'Inactive'])->nullable();
            $table->enum('m365_email_status', ['Active', 'Inactive'])->nullable();
            $table->enum('canva_login_status', ['Active', 'Inactive'])->nullable();
            $table->enum('lr_portal_status', ['Active', 'Inactive'])->nullable();
            $table->enum('l4t_recipient', ['Yes', 'No'])->nullable();
            $table->enum('smart_tv_recipient', ['Yes', 'No'])->nullable();
            $table->enum('l4nt_recipient', ['Yes', 'No'])->nullable();
            $table->string('suffix_name', 255)->nullable();
            $table->unsignedBigInteger('ro_office_id')->nullable();
            $table->unsignedBigInteger('sdo_office_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->tinyInteger('officer_in_charge')->default(0);
            $table->string('mobile_no_1', 255)->nullable();
            $table->string('mobile_no_2', 255)->nullable();
            $table->string('personal_email_address', 255)->nullable();
            $table->date('date_hired')->nullable();
            $table->tinyInteger('inactive')->default(0);
            $table->text('office_of_oic_designation')->nullable();
            $table->date('date_of_separation')->nullable();
            $table->unsignedBigInteger('cause_of_separation_id')->nullable();
            $table->tinyInteger('non_deped_fund')->nullable()->default(0);
            $table->unsignedBigInteger('sources_of_fund_id')->nullable();
            $table->text('detailed_transfer_from')->nullable();
            $table->text('detailed_transfer_to')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unique('deped_email', 'deped_email');
            $table->index('school_id', 'fk_school_employee_id');
            $table->index('position_title_id', 'fk_position_title_id_employee');
            $table->index('ro_office_id', 'schools_employee_ro_office_id_foreign');
            $table->index('sdo_office_id', 'schools_employee_sdo_office_id_foreign');
            $table->index('position_id', 'schools_employee_position_id_foreign');
            $table->index('cause_of_separation_id', 'schools_employee_cause_of_separation');
            $table->index('sources_of_fund_id', 'school_employee_source_of_fund_id');
            $table->foreign('position_title_id', 'fk_position_title_id_employee')
                ->references('pk_school_position_id')
                ->on('position_title')
                ;
            $table->foreign('school_id', 'fk_school_employee_id')
                ->references('pk_school_id')
                ->on('schools')
                ;
            $table->foreign('sources_of_fund_id', 'school_employee_source_of_fund_id')
                ->references('id')
                ->on('school_employee_source_of_funds')
                ->onDelete('set null')
                ;
            $table->foreign('cause_of_separation_id', 'schools_employee_cause_of_separation')
                ->references('id')
                ->on('school_employee_cause_of_separations')
                ->onDelete('set null')
                ;
            $table->foreign('position_id', 'schools_employee_position_id_foreign')
                ->references('id')
                ->on('school_employee_position')
                ->onDelete('set null')
                ;
            $table->foreign('ro_office_id', 'schools_employee_ro_office_id_foreign')
                ->references('id')
                ->on('school_employee_ro_office')
                ->onDelete('set null')
                ;
            $table->foreign('sdo_office_id', 'schools_employee_sdo_office_id_foreign')
                ->references('id')
                ->on('school_employee_sdo_office')
                ->onDelete('set null')
                ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools_employee');
    }
};
