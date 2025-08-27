<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExerciseCategory;

class ExerciseCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Use your preferred list (taken from what you described)
        $categories = [
            'Neck',
            'Trapezius',
            'Shoulders',
            'Chest',
            'Back / Wing',
            'Erector Spinae',
            'Biceps',
            'Triceps',
            'Forearm',
            'Abs / Core',
            'Leg',
            'Calf',
            'Hips / Glutes',
            'Cardio',
            'Full Body',
        ];

        foreach ($categories as $name) {
            // idempotent: won’t create duplicates even if you run seeder again
            ExerciseCategory::firstOrCreate(['name' => $name]);
        }
    }
}
