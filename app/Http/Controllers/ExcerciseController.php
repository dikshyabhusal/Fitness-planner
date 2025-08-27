<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\ExerciseCategory;

class ExcerciseController extends Controller
{
    // public function index()
    // {
    //     $categories = ExerciseCategory::with('exercises')->get();
    //     $popularExercises = Exercise::orderBy('views', 'desc')->take(5)->get();
    //     return view('exercises.index', compact('categories', 'popularExercises'));
    // }
    public function category($id)
{
    $category = ExerciseCategory::with('exercises')->findOrFail($id);

    // Get exercises of this category, paginate
    $exercises = $category->exercises()->paginate(10);

    return view('exercises.index', compact('exercises', 'category'));
}

    public function show(Exercise $exercise)
    {
        $exercise->increment('views');
        return view('exercises.show', compact('exercise'));
    }

    public function create()
    {
        $categories = ExerciseCategory::all();
        return view('exercises.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'exercise_category_id' => 'required|exists:exercise_categories,id',
            'coach_tips' => 'nullable|string',
            'precautions' => 'nullable|string',
            'how_to_start' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('exercises/photos', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('exercises/videos', 'public');
        }

        $data['user_id'] = auth()->id();
        Exercise::create($data);

        return redirect()->route('exercises.index')->with('success', 'Exercise added successfully!');
    }
}
