<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietCategory;
use App\Models\UserDietPlan;
use Illuminate\Support\Facades\Auth;

class UserDietPlanController extends Controller
{
    public function stepOneForm()
    {
        return view('diet.step1');
    }

    public function storeStepOne(Request $request)
{
    $request->validate([
        'goal' => 'required|string',
        'target_area' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null; // ✅ fix: initialize to avoid undefined variable

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $imagePath = $file->storeAs('diet_images', $filename, 'public');
    }

    $category = DietCategory::create([
        'goal' => $request->goal,
        'target_area' => $request->target_area,
        'image' => $imagePath,
    ]);

    return redirect()->route('diet.step2.form', $category->id);
}

    public function stepTwoForm(DietCategory $category)
    {
        return view('diet.step2', compact('category'));
    }

    public function storeStepTwo(Request $request, DietCategory $category)
    {
        $request->validate([
            'days' => 'required|array',
        ]);

        foreach ($request->days as $day => $meals) {
            foreach (['breakfast', 'lunch', 'dinner'] as $meal_time) {
                UserDietPlan::create([
                    'user_id' => Auth::id(),
                    'diet_category_id' => $category->id,
                    'day_number' => $day,
                    'meal_time' => $meal_time,
                    'meal' => $meals[$meal_time] ?? 'N/A',
                ]);
            }
        }

        return redirect()->route('diet.step1.form')->with('success', 'Diet Plan Created Successfully!');
    }
//     public function show(UserDietPlan $userDietPlan)
// {
//     // Assuming you want to show all plans for this user for that category
//     $plans = UserDietPlan::with('category')
//         ->where('user_id', $userDietPlan->user_id)
//         ->where('diet_category_id', $userDietPlan->diet_category_id)
//         ->orderBy('day_number')
//         ->get();

//     return view('diet.show', compact('plans'));
// }
    public function categories(Request $request)
{
    $query = DietCategory::query();

    // Search by target area or goal
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('target_area', 'LIKE', "%{$search}%")
              ->orWhere('goal', 'LIKE', "%{$search}%");
        });
    }

    // Filter by target_area
    if ($request->filled('target_area')) {
        $query->where('target_area', $request->target_area);
    }

    // Filter by goal
    if ($request->filled('goal')) {
        $query->where('goal', $request->goal);
    }

    $categories = $query->latest()->get();

    // Pass unique values for filters
    $targetAreas = DietCategory::select('target_area')->distinct()->pluck('target_area');
    $goals = DietCategory::select('goal')->distinct()->pluck('goal');

    return view('diet.categories', compact('categories', 'targetAreas', 'goals'));
}

    // Show all diet plans under a category
    public function categoryPlans($id)
    {
        $category = DietCategory::findOrFail($id);
        // Load diet plans grouped by day or just all plans for category
        // Here we get all diet plans for this category, grouped by day_number for UI
        $mealsCollection = UserDietPlan::where('diet_category_id', $id)
        ->orderBy('day_number')
        ->orderBy('meal_time')
        ->get()
        ->groupBy('day_number');

    // Ensure days are sequential, even if some are missing
    $maxDay = $mealsCollection->keys()->max() ?? 0;
    $meals = collect();
    for ($day = 1; $day <= $maxDay; $day++) {
        $meals->put($day, $mealsCollection->get($day, collect()));
    }
        return view('diet.category_plans', compact('category', 'meals'));
    }

    // Show full details of a diet plan (single plan could mean all meals of a day or a specific UserDietPlan record?)
    // Assuming you want all meals for a day of a category, let's pass category and day_number
    public function showPlan(UserDietPlan $dietPlan)
    {
        // Get all meals for same user_id, diet_category_id and day_number (assuming daily meal plan)
        $detailedMeals = UserDietPlan::where('user_id', $dietPlan->user_id)
            ->where('diet_category_id', $dietPlan->diet_category_id)
            ->where('day_number', $dietPlan->day_number)
            ->orderBy('meal_time')
            ->get();

        return view('diet.show_plan', compact('dietPlan', 'detailedMeals'));
    }

}
