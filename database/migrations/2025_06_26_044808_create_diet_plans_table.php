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
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_plan_id');
    $table->integer('day_number'); // Day 1 - 7
    $table->string('meal_time'); // Breakfast, Lunch, Dinner
    $table->string('meal'); // e.g. Eggs + Toast
    $table->timestamps();

    $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
    }
};
