<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class TrainerProfileController extends Controller
{
    public function show(User $trainer)
    {
        if (!$trainer->hasRole('trainer')) {
            abort(404);
        }

        $workouts = $trainer->workoutPlans; // assumes trainer has a hasMany relation to workouts

        return view('student.trainer-profile', compact('trainer', 'workouts'));
    }
}
