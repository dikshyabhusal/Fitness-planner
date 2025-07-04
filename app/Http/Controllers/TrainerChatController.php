<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TrainerChatController extends Controller
{
    public function chat(User $student)
    {
        // dd($student);
        return view('trainer.chat', compact('student'));
        
    }
}
