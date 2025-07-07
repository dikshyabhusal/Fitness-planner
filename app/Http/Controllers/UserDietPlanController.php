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
        ]);

        $category = DietCategory::create([
            'goal' => $request->goal,
            'target_area' => $request->target_area,
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
}
