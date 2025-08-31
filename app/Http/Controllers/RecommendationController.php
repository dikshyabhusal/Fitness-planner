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
//workout
public function showForm()
    {
        return view('recommendation.form');
    }


    // Handle recommendation logic
    public function recommends(Request $request)
    {
        // Validate input
        $request->validate([
            'goal' => 'required',
            'area' => 'required',
        ]);

        $user_goal = $request->input('goal');
        $focus_area = $request->input('area');

        // Example workout plans (can later use DB)
        $plans = [
            ['title' => 'Abs Burner', 'goal' => 'Lose Weight', 'area' => 'Abs'],
            ['title' => 'Mass Builder', 'goal' => 'Gain Muscle', 'area' => 'Chest'],
            ['title' => 'Leg Toning', 'goal' => 'Lose Weight', 'area' => 'Leg'],
            ['title' => 'Full Body Blast', 'goal' => 'Lose Weight', 'area' => 'Full Body'],
        ];

        // Convert plans to JSON and escape for shell
        $plans_json = escapeshellarg(json_encode($plans));

        // Build command to run Python script
        $command = "python3 " . base_path('python_scripts/recommend.py') . " "
                   . escapeshellarg($user_goal) . " "
                   . escapeshellarg($focus_area) . " "
                   . $plans_json;

        // Execute Python script
        $output = trim(shell_exec($command));

        // Decode JSON output safely
        $recommendations = json_decode($output, true);
        if (!is_array($recommendations)) {
            $recommendations = [];
        }

        // Return result view
        return view('recommendation.result', compact('recommendations'));
    }


}
