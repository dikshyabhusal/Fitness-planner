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
}
