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
        Schema::create('users', function (Blueprint $table) {
           $table->uuid('user_id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('no_ktp')->unique()->nullable();
            $table->bigInteger('npwp')->nullable();
            $table->enum('gender', ['P', 'L'])->nullable();
            $table->enum('work', ['bekerja', 'mahasiswa'])->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['menikah', 'belum menikah'])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('ktp_picture')->nullable();
            $table->string('ktp_picture_person')->nullable();
            $table->enum('status_verification', ['pending', 'verified', 'reject'])->nullable();
            $table->text('rejection_feedback')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->enum('role', ['admin', 'owner', 'user'])->default('user');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
