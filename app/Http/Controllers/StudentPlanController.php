<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\DietPlan;
use App\Models\StudentPlanProgress;
use Illuminate\Support\Facades\Auth;

class StudentPlanController extends Controller
{
    // public function show($planId)
    // {
    //     $plan = WorkoutPlan::with(['trainer', 'days', 'reviews.student'])->findOrFail($planId);
    //     $diet = DietPlan::where('workout_plan_id', $planId)
    //                     ->orderBy('day_number')
    //                     ->get()
    //                     ->groupBy('day_number');

    //     // Get student progress if exists
    //     $progress = StudentPlanProgress::firstOrCreate(
    //         ['student_id' => Auth::id(), 'workout_plan_id' => $planId],
    //         ['current_day' => 1]
    //     );

    //     return view('student.workout_plans.show', compact('plan', 'diet', 'progress'));
    // }

    // public function markDone(Request $request, $planId)
    // {
    //     $progress = StudentPlanProgress::where('student_id', Auth::id())
    //                 ->where('workout_plan_id', $planId)
    //                 ->firstOrFail();

    //     // Move to next day or complete
    //     if ($progress->current_day < $progress->workoutPlan->duration_days) {
    //         $progress->current_day++;
    //     } else {
    //         $progress->completed = true;
    //     }
    //     $progress->save();

    //     return redirect()->back()->with('success', 'Day marked as done!');
    // }
}
