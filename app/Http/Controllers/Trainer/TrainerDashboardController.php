<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\User;

class TrainerDashboardController extends Controller
{
    public function index()
    {
        // Get all users with the 'student' role
        $students = User::role('student')->get();

        return view('dashboard.trainer', compact('students'));
    }
}
