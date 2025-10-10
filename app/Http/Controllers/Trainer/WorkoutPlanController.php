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
    public function index(Request $request)
{
    $query = WorkoutPlan::where('trainer_id', Auth::id());

    // Search filter
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $plans = $query->latest()->get();

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
            'diet' => 'required|array',
            'image' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|integer|in:0,1,2',
        ]);
        // dd($request->file('image'));
        $imagePath = null; // ✅ fix: initialize to avoid undefined variable

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $imagePath = $file->storeAs('workout_images', $filename, 'public');
    }

        // $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('workout_images', 'public');
        // }

        $plan = WorkoutPlan::create([
            'trainer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'gender' => $request->gender,
            'duration_days' => $request->duration_days,
            'image' => $imagePath,
            'difficulty_level'=>$request->difficulty_level,
        ]);

        $duration = $request->duration_days;

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

        return redirect()->route('trainer.workout_plans.index')->with('success', 'Workout plan created successfully!');
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:male,female,both',
            'duration_days' => 'required|integer|min:1',
            'workout_days' => 'required|array',
            'diet' => 'required|array',
            'image' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|integer|in:0,1,2',
        ]);

        $plan = WorkoutPlan::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('workout_images', 'public');
            $plan->image = $imagePath;
            $plan->save();
        }

        $plan->update([
            'title' => $request->title,
            'description' => $request->description,
            'gender' => $request->gender,
            'duration_days' => $request->duration_days,
            'difficulty_level'=>$request->difficulty_level,
        ]);

        WorkoutDay::where('workout_plan_id', $plan->id)->delete();
        DietPlan::where('workout_plan_id', $plan->id)->delete();

        $duration = $request->duration_days;

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

        return redirect()->route('trainer.workout_plans.show', $plan->id)->with('success', 'Workout Plan updated successfully!');
    }

    public function destroy($id)
    {
        $plan = WorkoutPlan::findOrFail($id);

        if ($plan->trainer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $plan->delete();

        return redirect()->route('trainer.workout_plans.index')->with('success', 'Workout Plan deleted successfully!');
    }
}
