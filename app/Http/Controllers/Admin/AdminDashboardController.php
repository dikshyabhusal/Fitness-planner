<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkoutPlan;
use App\Models\DietPlan;
use App\Models\Review;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.admin', [
    'userCount' => User::count(),
    'planCount' => WorkoutPlan::count(),
    'dietCount' => DietPlan::count(),
    'userRoles' => User::with('roles')->get()->groupBy(fn ($user) => $user->roles->pluck('name')->first() ?? 'None')->map->count(),
    'workoutChart' => WorkoutPlan::all()->groupBy('goal')->map->count(),
]);

    }

    public function users()
    {
        return view('admin.users', ['users' => User::all()]);
    }

    public function workouts()
    {
        $workouts = WorkoutPlan::latest()->get(); // You can customize this query
    return view('admin.workouts', compact('workouts'));
    }

    public function diets()
    {
        $diets = DietPlan::latest()->get();
    return view('admin.diets', compact('diets'));
        
    }

    public function reviews()
    {
        $reviews = Review::with(['student', 'trainer', 'workoutPlan'])->latest()->get();
    return view('admin.reviews', compact('reviews'));
    }
    public function contacts()
{
    $contacts = Contact::latest()->get();
    return view('admin.contacts', compact('contacts'));
}
public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,trainer,student',
        ]);

        $user = User::findOrFail($id);

        // Remove existing roles and assign new one
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users')->with('success', 'Role updated successfully.');
    }
}
