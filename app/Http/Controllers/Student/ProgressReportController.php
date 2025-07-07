<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkoutPlan;
use App\Models\Progress;

class ProgressReportController extends Controller
{
    public function show($planId)
    {
        $plan = WorkoutPlan::findOrFail($planId);

        $progressRecords = Progress::where('user_id', Auth::id())
            ->where('workout_plan_id', $planId)
            ->orderBy('date')
            ->get();

        $totalDays = $plan->duration_days;

        // Prepare data for chart
        $labels = [];
        $workoutData = [];
        $dietData = [];

        for ($i = 0; $i < $totalDays; $i++) {
            $date = now()->startOfDay()->subDays($totalDays - $i - 1)->toDateString();
            $labels[] = $date;

            $record = $progressRecords->firstWhere('date', $date);
            $workoutData[] = $record?->workout_done ? 1 : 0;
            $dietData[] = $record?->diet_done ? 1 : 0;
        }

        // Calculate % complete
        $completedWorkout = array_sum($workoutData);
        $completedDiet = array_sum($dietData);
        $percentWorkout = round(($completedWorkout / $totalDays) * 100, 1);
        $percentDiet = round(($completedDiet / $totalDays) * 100, 1);

        return view('student.progress-report', compact(
            'plan',
            'labels',
            'workoutData',
            'dietData',
            'percentWorkout',
            'percentDiet'
        ));
    }
}

