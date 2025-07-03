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
        Schema::create('workout_plans', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('trainer_id'); // FK to users table
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('gender', ['male', 'female', 'both'])->default('both'); // Filter type
            $table->integer('duration_days'); // e.g. 7, 14, 30
            $table->timestamps();

            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
