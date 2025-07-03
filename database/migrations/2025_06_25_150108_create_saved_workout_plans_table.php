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
        Schema::create('saved_workout_plans', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('student_id'); // FK to users table
        $table->unsignedBigInteger('workout_plan_id'); // FK to workout_plans
        $table->timestamps();

        $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_workout_plans');
    }
};
