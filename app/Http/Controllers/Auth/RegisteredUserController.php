<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    

        public function store(Request $request): RedirectResponse
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'in:student,trainer'],
                'gender' => ['nullable', 'string'],
                'age' => ['nullable', 'integer'],
                'height' => ['nullable', 'numeric'],
                'weight' => ['nullable', 'numeric'],
                'goal' => ['nullable', 'string'],
                'activity_level' => ['nullable', 'string'],
                'daily_calorie_need' => ['nullable', 'numeric'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
                'goal' => $request->goal,
                'activity_level' => $request->activity_level,
                'daily_calorie_need' => $request->daily_calorie_need,
            ]);

            $user->assignRole($request->role);

            event(new Registered($user));
            Auth::login($user);

            return redirect(route('dashboard'));
        }

}
