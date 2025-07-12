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
            $table->integer('quantity');
            $table->enum('status', ['kosong', 'terisi', 'booking'])->default('kosong');
            $table->enum('type', ['campur', 'putri', 'putra']);
            $table->bigInteger('price');
            $table->json('facility')->nullable();
            $table->json('regulation')->nullable();
            $table->text('address');
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
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
