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
        Schema::create('workout_days', function (Blueprint $table) {
             $table->id();
        $table->unsignedBigInteger('workout_plan_id'); // FK to workout_plans
        $table->integer('day_number'); // Day 1, 2, 3...
        $table->string('title'); // e.g., Full Body, Rest
        $table->text('description')->nullable(); // Optional details
        $table->timestamps();

        $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_days');
    }
};
