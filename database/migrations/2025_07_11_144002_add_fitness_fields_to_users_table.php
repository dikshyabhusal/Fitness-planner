<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->float('height')->nullable(); // in cm
            $table->float('weight')->nullable(); // in kg
            $table->string('goal')->nullable();
            $table->string('activity_level')->nullable();
            $table->integer('daily_calorie_need')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'age', 'height', 'weight', 'goal', 'activity_level', 'daily_calorie_need']);
        });
    }

};
