<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diet_categories', function (Blueprint $table) {
            $table->id();
            $table->string('goal');         // Lose Weight, Gain Weight
            $table->string('target_area');  // Belly, Hip, Chest, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diet_categories');
    }
};
