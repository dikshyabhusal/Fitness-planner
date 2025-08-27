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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('exercise_category_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('coach_tips')->nullable();
    $table->text('precautions')->nullable();
    $table->text('how_to_start')->nullable();
    $table->string('photo')->nullable();   // image path
    $table->string('video')->nullable();   // video path
    $table->unsignedBigInteger('views')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
