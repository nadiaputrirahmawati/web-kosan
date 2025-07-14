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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('room_id')->primary();
            $table->uuid('user_id');
            $table->string('name')->nullable();
            $table->integer('total_rooms')->nullable();
            $table->integer('occupied_rooms')->nullable();
            $table->enum('type', ['campur', 'putri', 'putra']);
            $table->bigInteger('price');
            $table->bigInteger('deposit_amount');
            $table->json('room_facility')->nullable();
            $table->json('public_facility')->nullable();
            $table->json('regulation')->nullable();
            $table->text('address');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
