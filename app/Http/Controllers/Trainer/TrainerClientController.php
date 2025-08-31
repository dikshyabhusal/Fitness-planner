<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;

use App\Models\User;
class TrainerClientController extends Controller
{
    public function index()
    {
        $students = User::role('student')->get();
        return view('trainer.clients.index', compact('students'));
    }
    public function exercises()
{
    // Get only trainer's exercises with category
    $exercises = auth()->user()->exercises()->with('category')->latest()->get();
    return view('exercises.view', compact('exercises'));
}

    public function diets()
{
    $diets = auth()->user()->diets()->with('category')->latest()->get(); // now uses correct table
    return view('diet.view', compact('diets'));
}

}
