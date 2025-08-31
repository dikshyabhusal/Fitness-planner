<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\ExerciseCategory;

class ExcerciseController extends Controller
{
    public function index()
{
    // Get all exercises with pagination
    $exercises = Exercise::latest()->paginate(9);

    return view('exercises.index', compact('exercises'));
}

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

     public function edit(Exercise $exercise)
    {
        return view('exercises.edit', compact('exercise'));
    }

    // Update exercise
    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10240',
            'coach_tips' => 'nullable|string',
            'precautions' => 'nullable|string',
            'how_to_start' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'coach_tips', 'precautions', 'how_to_start']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('exercises/photos', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('exercises/videos', 'public');
        }

        $exercise->update($data);

        return redirect()->route('exercises.show', $exercise->id)
                         ->with('success', 'Exercise updated successfully!');
    }

    // Delete exercise
    public function destroy(Exercise $exercise)
    {
        // Optional: Delete old files
        if ($exercise->photo && file_exists(storage_path('app/public/'.$exercise->photo))) {
            unlink(storage_path('app/public/'.$exercise->photo));
        }
        if ($exercise->video && file_exists(storage_path('app/public/'.$exercise->video))) {
            unlink(storage_path('app/public/'.$exercise->video));
        }

        $exercise->delete();

        return redirect()->route('exercises.index')
                         ->with('success', 'Exercise deleted successfully!');
    }
}
