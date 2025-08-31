<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tips')->insert([
            ['text' => 'Drink at least 8 glasses of water daily.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Consistency beats intensity.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Warm up before every workout.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Focus on proper form, not heavy weights.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Include strength training in your routine.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Take rest days to allow muscles to recover.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Eat protein with every meal.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Track your progress for motivation.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Combine cardio and strength for overall fitness.', 'created_at' => now(), 'updated_at' => now()],
            ['text' => 'Listen to your body and avoid overtraining.', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
