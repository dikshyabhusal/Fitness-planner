<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseVideo;
class ExerciseVideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = ExerciseVideo::query();

        if ($request->filled('body_part')) {
            $videos->where('body_part', $request->body_part);
        }
        if ($request->filled('goal')) {
            $videos->where('goal', $request->goal);
        }
        if ($request->filled('duration')) {
            $videos->where('duration', '<=', $request->duration);
        }

        return view('videos.index', ['videos' => $videos->paginate(10)]);
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'video' => 'required|mimes:mp4,mov,avi|max:51200000',
        'body_part' => 'required',
        'goal' => 'required',
        'duration' => 'required|integer',
    ]);

    $path = $request->file('video')->store('videos', 'public');

    ExerciseVideo::create([
        'trainer_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'video_path' => $path,
        'body_part' => $request->body_part,
        'goal' => $request->goal,
        'duration' => $request->duration,
    ]);

    return redirect()->route('videos.create')->with('success', 'Video uploaded successfully.');
}
public function trainerindex()
{
    $videos = ExerciseVideo::all();
    return view('videos.trainerindex', compact('videos'));
}
public function edit($id)
{
    $video = ExerciseVideo::findOrFail($id);
    return view('videos.edit', compact('video'));
}

public function update(Request $request, $id)
{
    $video = ExerciseVideo::findOrFail($id);
    $video->update($request->all());
    return redirect()->route('videos.trainerindex')->with('success', 'Video updated successfully!');
}

public function destroy($id)
{
    $video = ExerciseVideo::findOrFail($id);
    if (file_exists(public_path($video->video_path))) {
        unlink(public_path($video->video_path));
    }
    $video->delete();
    return redirect()->route('videos.trainerindex')->with('success', 'Video deleted successfully!');
}

}
