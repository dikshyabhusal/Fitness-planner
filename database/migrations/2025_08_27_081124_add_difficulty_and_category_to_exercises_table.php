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
    Schema::table('exercises', function (Blueprint $table) {
        $table->string('difficulty')->default('Beginner'); // Beginner / Intermediate / Advanced
        $table->string('exercise_type')->nullable(); // Strength / Cardio / Flexibility
    });
}

public function down()
{
    Schema::table('exercises', function (Blueprint $table) {
        $table->dropColumn(['difficulty', 'exercise_type']);
    });
}

};
