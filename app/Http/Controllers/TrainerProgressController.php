<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Progress;
use Illuminate\Http\Request;

class TrainerProgressController extends Controller
{
    public function index()
    {
        // Get students who have the role 'student' and are assigned to the current trainer
        $students = User::role('student');
            

        return view('trainer.progress.index', compact('students'));
    }

    public function show(User $student)
    {
        // Authorization: ensure the student belongs to the trainer
        abort_if($student->id !== auth()->id(), 403);

        // Get progress records for this student
        $progress = Progress::where('user_id', $student->id)->orderBy('date')->get();

        return view('trainer.progress.show', compact('student', 'progress'));
    }
}
