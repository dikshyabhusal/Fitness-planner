<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;

class WelcomeController extends Controller
{
    public function index()
    {
        $plans = WorkoutPlan::latest()->take(6)->get(); // get latest 6
        return view('welcome', compact('plans'));
    }
}

