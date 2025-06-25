<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // public function showRegistrationForm()
    // {
    //     return view('auth.register');
    // }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name'     => 'required|string|max:255',
    //         'email'    => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role'     => 'required|in:student,trainer',
    //     ]);

    //     $user = User::create([
    //         'name'     => $request->name,
    //         'email'    => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $user->assignRole($request->role);

    //     Auth::login($user);

    //     return redirect()->route('dashboard');
    // }
}
