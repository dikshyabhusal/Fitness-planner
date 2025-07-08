<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietCategory;
use App\Models\UserDietPlan;
use App\Models\DietBookmark;
use Illuminate\Support\Facades\Auth;
class RecommendationController extends Controller
{
    public function form()
    {
        $goals = DietCategory::pluck('goal')->unique();
        return view('diet.recommend_form', compact('goals'));
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'goal' => 'required|string',
            'target_area' => 'required|string',
        ]);

        $categories = DietCategory::where('goal', $request->goal)
            ->where('target_area', $request->target_area)
            ->get();

        return view('diet.recommend_result', compact('categories'));
    }

    public function show($category_id)
    {
        $meals = UserDietPlan::where('diet_category_id', $category_id)
            ->orderBy('day_number')
            ->get()
            ->groupBy('day_number');

        $category = DietCategory::findOrFail($category_id);

        return view('diet.recommend_detail', compact('meals', 'category'));
    }
//for bookmarks
    public function bookmark($id)
{
    $userId = Auth::id();

    $bookmark = DietBookmark::where('user_id', $userId)
        ->where('diet_category_id', $id)
        ->first();

    if ($bookmark) {
        // If already bookmarked, remove it (unbookmark)
        $bookmark->delete();
        return back()->with('success', 'Bookmark removed!');
    } else {
        // Otherwise, create a new bookmark
        DietBookmark::create([
            'user_id' => $userId,
            'diet_category_id' => $id,
        ]);
        return back()->with('success', 'Diet plan bookmarked!');
    }
}

}
