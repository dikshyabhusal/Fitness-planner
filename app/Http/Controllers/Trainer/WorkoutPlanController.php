<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\WorkoutDay;
use App\Models\DietPlan;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    public function index()
    {
        $plans = WorkoutPlan::where('trainer_id', Auth::id())->get();
        return view('trainer.workout_plans.index', compact('plans'));
    }

    public function create()
    {
        return view('trainer.workout_plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:male,female,both',
            'duration_days' => 'required|integer|min:1',
            'workout_days' => 'required|array',
            'diet' => 'required|array'
        ]);

        // Create workout plan
        $plan = WorkoutPlan::create([
            'trainer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'gender' => $request->gender,
            'duration_days' => $request->duration_days,
        ]);

        $duration = $request->duration_days;

        // Save workout days – repeat 7-day cycle
        for ($i = 1; $i <= $duration; $i++) {
            $repeatIndex = ($i - 1) % 7 + 1;
            $dayData = $request->workout_days[$repeatIndex];

            WorkoutDay::create([
                'workout_plan_id' => $plan->id,
                'day_number' => $i,
                'title' => $dayData['title'],
                'description' => $dayData['description'] ?? null,
            ]);
        }

        // Save 7-day diet plan (breakfast, lunch, dinner per day)
        foreach ($request->diet as $day => $meals) {
            foreach (['breakfast', 'lunch', 'dinner'] as $meal_time) {
                DietPlan::create([
                    'workout_plan_id' => $plan->id,
                    'day_number' => $day,
                    'meal_time' => $meal_time,
                    'meal' => $meals[$meal_time] ?? '',
                ]);
            }
        }

        return redirect()->route('trainer.workout_plans.index')->with('success', 'Workout plan created successfully with exercises and diet!');
    }

    public function show($id)
    {
        $plan = WorkoutPlan::with(['days', 'trainer'])->findOrFail($id);
        $diet = DietPlan::where('workout_plan_id', $id)->orderBy('day_number')->get()->groupBy('day_number');

        return view('trainer.workout_plans.show', compact('plan', 'diet'));
    }

    public function edit($id)
    {
        $plan = WorkoutPlan::with('days')->findOrFail($id);
        $diet = DietPlan::where('workout_plan_id', $id)->get()->groupBy('day_number');
        return view('trainer.workout_plans.edit', compact('plan', 'diet'));
    }

    // public function update(Request $request, $id)
    // {
    //     $plan = WorkoutPlan::findOrFail($id);

    //     $plan->update([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'gender' => $request->gender,
    //         'duration_days' => $request->duration_days,
    //     ]);

    //     // You can optionally update workout_days and diet_plans here

    //     return redirect()->route('trainer.workout_plans.show', $plan->id)->with('success', 'Workout Plan updated!');
    // }
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'gender' => 'required|in:male,female,both',
        'duration_days' => 'required|integer|min:1',
        'workout_days' => 'required|array',
        'diet' => 'required|array'
    ]);

    $plan = WorkoutPlan::findOrFail($id);

    // Update basic plan info
    $plan->update([
        'title' => $request->title,
        'description' => $request->description,
        'gender' => $request->gender,
        'duration_days' => $request->duration_days,
    ]);

    // Delete existing workout_days and diet_plans for clean update
    WorkoutDay::where('workout_plan_id', $plan->id)->delete();
    DietPlan::where('workout_plan_id', $plan->id)->delete();

    $duration = $request->duration_days;

    // Re-save workout days – repeat 7-day base plan
    for ($i = 1; $i <= $duration; $i++) {
        $repeatIndex = ($i - 1) % 7 + 1;
        $dayData = $request->workout_days[$repeatIndex];

        WorkoutDay::create([
            'workout_plan_id' => $plan->id,
            'day_number' => $i,
            'title' => $dayData['title'],
            'description' => $dayData['description'] ?? null,
        ]);
    }

    // Re-save 7-day diet plan (3 meals per day)
    foreach ($request->diet as $day => $meals) {
        foreach (['breakfast', 'lunch', 'dinner'] as $meal_time) {
            DietPlan::create([
                'workout_plan_id' => $plan->id,
                'day_number' => $day,
                'meal_time' => $meal_time,
                'meal' => $meals[$meal_time] ?? '',
            ]);
        }
    }

    return redirect()->route('trainer.workout_plans.show', $plan->id)
        ->with('success', 'Workout Plan updated successfully!');
}


public function destroy($id)
{
    $plan = WorkoutPlan::findOrFail($id);

    // Optional: check if the logged-in user owns the plan
    if ($plan->trainer_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $plan->delete(); // Will also delete related days & diets via foreign key cascade

    return redirect()->route('trainer.workout_plans.index')->with('success', 'Workout Plan deleted successfully!');
}


}
