<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->tinyInteger('difficulty_level')->default(0)
                  ->comment('0: Easy, 1: Medium, 2: Hard')
                  ->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->dropColumn('difficulty_level');
        });
    }
};
