<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\WorkoutPlan;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'workout_plan_id' => 'required|exists:workout_plans,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required',
        ]);

        $plan = WorkoutPlan::findOrFail($request->workout_plan_id);

        Review::create([
            'student_id' => auth()->id(),
            'trainer_id' => $plan->trainer_id,
            'workout_plan_id' => $plan->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }
}

