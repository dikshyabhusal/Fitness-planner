<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class TrainerWorkoutController extends Controller
{
    // Show all workouts created by this trainer
    public function index()
    {
        $workouts = WorkoutPlan::where('trainer_id', Auth::id())->get();
        return view('trainer.my_workouts', compact('workouts'));
    }

    // Show student progress for a given workout
    public function progress($id)
    {
        $workout = WorkoutPlan::where('trainer_id', Auth::id())->findOrFail($id);

        // Group progress by student
        $progressData = Progress::where('workout_plan_id', $id)
            ->with('student') // Relation in Progress model
            ->get()
            ->groupBy('user_id');

        return view('trainer.workout_progress', compact('workout', 'progressData'));
    }
    
}
