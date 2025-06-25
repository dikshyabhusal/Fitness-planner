<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function show($slug)
    {
        $workouts = [
            'bodybuilding' => [
                'title' => 'Bodybuilding Workout',
                'description' => 'A powerful training plan focused on hypertrophy and strength building. Includes compound lifts like squats, deadlifts, and bench press.',
                'video' => 'https://www.youtube.com/embed/2tM1LFFxeKg',
            ],
            'fitness' => [
                'title' => 'Fitness Routine',
                'description' => 'A dynamic mix of cardio, strength, and mobility drills for overall wellness and fat loss.',
                'video' => 'https://www.youtube.com/embed/UBMk30rjy0o',
            ],
            'cardio' => [
                'title' => 'Cardio Blast',
                'description' => 'High-intensity fat-burning workouts like HIIT, jump rope, running and mountain climbers.',
                'video' => 'https://www.youtube.com/embed/ml6cT4AZdqI',
            ],
            'pilates' => [
                'title' => 'Pilates Session',
                'description' => 'Low-impact workout focusing on core strength, flexibility, and controlled movements.',
                'video' => 'https://www.youtube.com/embed/lCg_gh_fppI',
            ],
        ];

        if (!array_key_exists($slug, $workouts)) {
            abort(404);
        }

        return view('workout.show', ['workout' => $workouts[$slug]]);
    }

}
