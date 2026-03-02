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
        Schema::create('i_s_p_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('school_internet_id');
            $table->foreign('school_internet_id')
                ->references('pk_isp_details_id')
                ->on('isp_details')
                ->onDelete('cascade');
            $table->decimal('cost_per_month', 10, 2)->nullable();
            $table->string('account_number')->unique();
            $table->string('description')->nullable();
            $table->enum('subscription_type', ['Prepaid', 'Postpaid'])->nullable();
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->boolean('inactive_contract')->default(false);
            $table->boolean('active_isp_counter')->default(true);

            $table->unsignedBigInteger('mode_of_acq_id')->nullable(); // FK
            $table->foreign('mode_of_acq_id')
                ->references('id')
                ->on('i_s_p_mode_of_acqs')
                ->onDelete('set null');

            $table->unsignedBigInteger('source_of_acq_id')->nullable(); // FK
            $table->foreign('source_of_acq_id')
                ->references('id')
                ->on('i_s_p_source_of_acqs')
                ->onDelete('set null');

            $table->text('donor')->nullable();

            $table->unsignedBigInteger('source_of_fund_id')->nullable(); // FK
            $table->foreign('source_of_fund_id')
                ->references('id')
                ->on('i_s_p_source_of_funds')
                ->onDelete('set null');

            $table->integer('total_no_access_points')->nullable();
            $table->boolean('active_counter1')->default(true);
            $table->text('location_of_access_points')->nullable();
            $table->integer('total_admin_area_isps')->nullable();
            $table->boolean('active_counter2')->default(true);

            $table->unsignedBigInteger('admin_area_rate_id')->nullable();  // FK
            $table->foreign('admin_area_rate_id')
                ->references('id')
                ->on('i_s_p_ratings')
                ->onDelete('set null');

            $table->integer('total_classroom_isps')->nullable();
            $table->boolean('active_counter3')->default(true);

            $table->unsignedBigInteger('classroom_area_rate_id')->nullable();  // FK
            $table->foreign('classroom_area_rate_id')
                ->references('id')
                ->on('i_s_p_ratings')
                ->onDelete('set null');
            $table->integer('rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_s_p_infos');
    }
};
