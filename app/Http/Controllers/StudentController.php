<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function savedData()
{
    $user = auth()->user(); // Logged-in student
    $savedWorkouts = $user->savedWorkouts; // Relationship from User model

    return view('student.saved-data', compact('savedWorkouts'));
}

}
