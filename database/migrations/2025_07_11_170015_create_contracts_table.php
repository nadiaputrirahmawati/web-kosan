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
        Schema::create('contracts', function (Blueprint $table) {
            $table->uuid('contract_id')->primary();
            $table->uuid('owner_id');
            $table->uuid('user_id');
            $table->uuid('room_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'completed', 'cancelled', 'in_renewal', 'pending_payment']);
            $table->string('signature')->nullable();
            $table->bigInteger('deposit_amount')->nullable();
            $table->enum('verification_contract', ['pending', 'rejected', 'completed'])->nullable();
            $table->text('rejection_feedback')->nullable();
            $table->enum('contract_type', ['initial', 'renewal'])->nullable();
            $table->timestamps();
            
            $table->foreign('owner_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
