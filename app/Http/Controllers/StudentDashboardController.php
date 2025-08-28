<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get recommended exercises
        $recommendedExercises = $this->getRecommendedExercises($user);

        return view('dashboard.student', compact('recommendedExercises'));
    }

    private function getRecommendedExercises($user, $limit = 5)
    {
        $query = Exercise::query();

        // Recommendation logic based on activity_level
        if ($user->activity_level === 'low') {
            $query->whereIn('exercise_category_id', [1, 2, 3]);
        } elseif ($user->activity_level === 'medium') {
            $query->whereIn('exercise_category_id', [4, 5, 6]);
        } elseif ($user->activity_level === 'high') {
            $query->whereIn('exercise_category_id', [7, 8, 9]);
        }

        $exercises = $query->inRandomOrder()->limit($limit)->get();

        // fallback if nothing matches
        if ($exercises->isEmpty()) {
            $exercises = Exercise::inRandomOrder()->limit($limit)->get();
        }

        return $exercises;
    }
}
