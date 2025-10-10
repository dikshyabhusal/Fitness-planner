<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\SavedWorkoutPlan;
use App\Models\DietPlan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class WorkoutPlanController extends Controller
{
    public function index(Request $request)
{
    $query = WorkoutPlan::with('trainer');

    // Search by title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter by gender
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    $plans = $query->orderBy('created_at', 'desc')->get();

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


    public function recommend(Request $request)
{
    $user = Auth::user(); // get currently logged-in user

    $data = [
        'age' => $user->age,          // fetch from users table
        'gender' => $user->gender,
        'height' => $user->height,
        'weight' => $user->weight,
        'goal' => $user->goal,        // if goal is stored in users table
    ];

    $jsonData = json_encode($data);

    $process = new Process([
        'python',
        base_path('python_scripts/recommend_workouts.py'),
        $jsonData
    ]);
    $process->run();

    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    $output = $process->getOutput();

    return view('recommendations', ['output' => $output]);
}

}
