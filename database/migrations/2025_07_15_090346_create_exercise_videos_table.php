<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('exercise_videos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('trainer_id');
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('video_path');
        $table->string('body_part'); // chest, abs, legs, etc.
        $table->string('goal'); // e.g., weight loss, gain
        $table->integer('duration'); // in minutes
        $table->timestamps();

        $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_videos');
    }
};
