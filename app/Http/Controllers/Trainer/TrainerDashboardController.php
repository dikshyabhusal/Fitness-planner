<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TrainerDashboardController extends Controller
{
    public function index()
{
    $students = User::role('student')->get();

    $latestWorkoutPlans = auth()->user()->workoutPlans()->latest()->take(8)->get();

    return view('dashboard.trainer', compact('students', 'latestWorkoutPlans'));
}

}
