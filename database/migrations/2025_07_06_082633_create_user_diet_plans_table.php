<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('user_diet_plans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('diet_category_id'); // lose/gain + belly etc.
        $table->integer('day_number');
        $table->string('meal_time'); // breakfast, lunch, dinner
        $table->string('meal');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('diet_category_id')->references('id')->on('diet_categories')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('user_diet_plans');
}

};
