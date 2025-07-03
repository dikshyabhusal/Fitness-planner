<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\Trainer\WorkoutPlanController as TrainerWorkoutPlanController;
use App\Http\Controllers\Student\WorkoutPlanController as StudentWorkoutPlanController;
use App\Http\Controllers\Trainer\TrainerDashboardController;
use App\Http\Controllers\Trainer\TrainerClientController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome')
    ;
});

// 🔧 Fixed: Use controller for role-based redirect
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/aboutauth', [AboutController::class, 'aboutauth'])->name('aboutauth');
// Route::get('/contact', [AboutController::class, 'contact'])->name('contact');
Route::get('/contact', [AboutController::class, 'show'])->name('contact.show');
Route::post('/contact', [AboutController::class, 'submit'])->name('contact.submit');


// Authenticated user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Custom Register Route with Role Selection
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// ✅ Role-Based Dashboards
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:trainer'])->get('/trainer/dashboard', function () {
    return view('dashboard.trainer');
})->name('trainer.dashboard');

Route::middleware(['auth', 'role:student'])->get('/student/dashboard', function () {
    return view('dashboard.student');
})->name('student.dashboard');

Route::get('/workout/{slug}', [WorkoutController::class, 'show'])->name('workout.show');
Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/workout-plans', [TrainerWorkoutPlanController::class, 'index'])->name('workout_plans.index');
    Route::get('/workout-plans/create', [TrainerWorkoutPlanController::class, 'create'])->name('workout_plans.create');
    Route::post('/workout-plans', [TrainerWorkoutPlanController::class, 'store'])->name('workout_plans.store');
});
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/workout-plans', [StudentWorkoutPlanController::class, 'index'])->name('workout_plans.index');
    Route::get('/workout-plans/{id}', [StudentWorkoutPlanController::class, 'show'])->name('workout_plans.show');
    Route::post('/workout-plans/{id}/save', [StudentWorkoutPlanController::class, 'save'])->name('workout_plans.save');
});

Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/workout-plans/{id}', action: [TrainerWorkoutPlanController::class, 'show'])->name('workout_plans.show');
    Route::get('/workout-plans/{id}/edit', [TrainerWorkoutPlanController::class, 'edit'])->name('workout_plans.edit');
    Route::put('/workout-plans/{id}', [TrainerWorkoutPlanController::class, 'update'])->name('workout_plans.update');
});

Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::delete('/workout-plans/{id}', [TrainerWorkoutPlanController::class, 'destroy'])->name('workout_plans.destroy');
});
Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/dashboard', [TrainerDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/clients', [TrainerClientController::class, 'index'])->name('clients.index');
});


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/saved-data', [StudentController::class, 'savedData'])
        ->name('student.saved.data');
});

// Breeze auth routes
require __DIR__.'/auth.php';
