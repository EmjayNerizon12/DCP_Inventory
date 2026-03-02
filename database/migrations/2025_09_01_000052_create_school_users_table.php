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
        Schema::create('school_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->integer('pk_school_id')->nullable();
            $table->string('username', 100)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('default_password', 255)->nullable();
            $table->dateTime('password_changed_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index('pk_school_id', 'pk_school_id');
            $table->foreign('pk_school_id', 'school_users_ibfk_1')
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
        Schema::dropIfExists('school_users');
    }
};
