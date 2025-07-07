<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\SavedWorkoutPlan;
use App\Models\DietPlan;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    public function index()
    {
        $plans = WorkoutPlan::with('trainer')->get(); // load trainer info
        return view('student.workout_plans.index', compact('plans'));
    }

    public function show($id)
    {
        // $plan = WorkoutPlan::with(['trainer', 'days'])->findOrFail($id);
        $plan = WorkoutPlan::with([
        'trainer',
        'days' => function ($query) {
            $query->orderBy('day_number')->limit(6); // Limit to 6 days
        }
    ])->findOrFail($id);

        // Load the diet plan grouped by day_number (1-7)
        $diet = DietPlan::where('workout_plan_id', $id)
            ->orderBy('day_number')
            ->get()
            ->groupBy('day_number');

        return view('student.workout_plans.show', compact('plan', 'diet'));
    }

    public function save($id)
    {
        SavedWorkoutPlan::firstOrCreate([
            'student_id' => Auth::id(), // logged in student
            'workout_plan_id' => $id,
        ]);

        return back()->with('success', 'Workout Plan saved!');
    }
}
