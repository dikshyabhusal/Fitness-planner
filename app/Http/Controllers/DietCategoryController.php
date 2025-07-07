<?php

namespace App\Http\Controllers;

use App\Models\DietCategory;
use App\Models\DietPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietCategoryController extends Controller
{
    public function index()
    {
        $categories = DietCategory::all();
        return view('diet.index', compact('categories'));
    }

    public function show($id)
    {
        $category = DietCategory::with('dietPlans')->findOrFail($id);
        return view('diet.show', compact('category'));
    }
    // public function create()
    // {
    //     return view('diet.create'); // render the view above
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'goal' => 'required|string',
    //         'target_area' => 'required|string',
    //         'title' => 'required|string',
    //         'meal_plan' => 'required|array',
    //     ]);

    //     // Create diet category (or you can relate it manually)
    //     $category = DietCategory::firstOrCreate([
    //         'goal' => $request->goal,
    //         'target_area' => $request->target_area,
    //     ]);

    //     // Save 7-day meal plan entries
    //     foreach ($request->meal_plan as $day => $meals) {
    //         foreach ($meals as $time => $meal) {
    //             DietPlan::create([
    //                 'user_id' => Auth::id(), // logged in trainer or admin
    //                 'diet_category_id' => $category->id,
    //                 'day_number' => $day,
    //                 'meal_time' => $time,
    //                 'meal' => $meal,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('diet.create')->with('success', 'Diet Plan added successfully.');
    // }
}
