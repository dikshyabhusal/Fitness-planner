<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\WorkoutPlan;
use App\Models\DietPlan;
use App\Models\SavedWorkoutPlan;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Recommended exercises
        $recommendedExercises = $this->getRecommendedExercises($user);

        // Get latest saved workout plan
        $savedPlan = SavedWorkoutPlan::where('student_id', $user->id)->latest()->first();

        $todayWorkout = null;
        $completionRate = 0;
        $completedDays = 0;
        $totalDays = 0;

        if ($savedPlan) {
            $plan = $savedPlan->workoutPlan;

            // Calculate current day number
            $startDate = Carbon::parse($savedPlan->created_at)->startOfDay();
            $todayNumber = Carbon::today()->diffInDays($startDate) + 1;

            // Get today's workout from plan days
            $todayWorkout = $plan->days()->where('day_number', $todayNumber)->first();

            // Progress summary from 'progress' table
            $totalDays = $plan->days()->count();
            $completedDays = Progress::where('user_id', $user->id)
                ->where('workout_plan_id', $plan->id)
                ->where('workout_done', 1)
                ->count();

            $completionRate = $totalDays > 0 ? round(($completedDays / $totalDays) * 100, 1) : 0;
        }

        // Random motivational quote
        $quotes = [
            "Push yourself, because no one else is going to do it for you.",
            "Success starts with self-discipline.",
            "Small progress is still progress.",
            "Don’t limit your challenges. Challenge your limits.",
            "It always seems impossible until it’s done.",
            "Push yourself, because no one else is going to do it for you.",
            "Success starts with self-discipline.",
            "Small progress is still progress.",
            "Don't limit your challenges. Challenge your limits.",
            "It always seems impossible until it's done.",
            "Believe you can and you're halfway there.",
            "Your only limit is you.",
            "Do something today that your future self will thank you for.",
            "Sweat is fat crying.",
            "Motivation is what gets you started. Habit is what keeps you going."
        ];
        $quote = $quotes[array_rand($quotes)];

        return view('dashboard.student', compact(
            'todayWorkout',
            'completionRate',
            'completedDays',
            'totalDays',
            'quote',
            'recommendedExercises'
        ));
    }

    private function getRecommendedExercises($user, $limit = 5)
    {
        $query = Exercise::query();

        if ($user->activity_level === 'low') {
            $query->whereIn('exercise_category_id', [1, 2, 3]);
        } elseif ($user->activity_level === 'medium') {
            $query->whereIn('exercise_category_id', [4, 5, 6]);
        } elseif ($user->activity_level === 'high') {
            $query->whereIn('exercise_category_id', [7, 8, 9]);
        }

        $exercises = $query->inRandomOrder()->limit($limit)->get();

        if ($exercises->isEmpty()) {
            $exercises = Exercise::inRandomOrder()->limit($limit)->get();
        }

        return $exercises;
    }

    // Mark today's workout as done
    public function markWorkoutDone(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        Progress::updateOrCreate(
            [
                'user_id' => $user->id,
                'workout_plan_id' => $request->workout_plan_id,
                'date' => $today
            ],
            [
                'workout_done' => 1
            ]
        );

        return back()->with('success', 'Workout marked as completed!');
    }
}
