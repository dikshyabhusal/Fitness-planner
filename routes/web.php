<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\Trainer\WorkoutPlanController as TrainerWorkoutPlanController;
use App\Http\Controllers\Student\WorkoutPlanController as StudentWorkoutPlanController;
use App\Http\Controllers\Trainer\TrainerDashboardController;
use App\Http\Controllers\Trainer\TrainerClientController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainerProfileController;
use App\Http\Controllers\TrainerChatController;

// 🏠 Public Pages
Route::get('/', fn () => view('welcome'));
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/aboutauth', [AboutController::class, 'aboutauth'])->name('aboutauth');
Route::get('/contact', [AboutController::class, 'show'])->name('contact.show');
Route::post('/contact', [AboutController::class, 'submit'])->name('contact.submit');

// 🧾 Dashboard Redirect
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Authenticated Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 👤 Custom Registration (with roles)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// 🧑‍💼 Admin Dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', fn () => view('dashboard.admin'))->name('admin.dashboard');

// 🏋️ Workout Detail (public route)
Route::get('/workout/{slug}', [WorkoutController::class, 'show'])->name('workout.show');

// 🧑‍🏫 Trainer Routes
Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/dashboard', [TrainerDashboardController::class, 'index'])->name('dashboard');

    // Workout Plans CRUD
    Route::get('/workout-plans', [TrainerWorkoutPlanController::class, 'index'])->name('workout_plans.index');
    Route::get('/workout-plans/create', [TrainerWorkoutPlanController::class, 'create'])->name('workout_plans.create');
    Route::post('/workout-plans', [TrainerWorkoutPlanController::class, 'store'])->name('workout_plans.store');
    Route::get('/workout-plans/{id}', [TrainerWorkoutPlanController::class, 'show'])->name('workout_plans.show');
    Route::get('/workout-plans/{id}/edit', [TrainerWorkoutPlanController::class, 'edit'])->name('workout_plans.edit');
    Route::put('/workout-plans/{id}', [TrainerWorkoutPlanController::class, 'update'])->name('workout_plans.update');
    Route::delete('/workout-plans/{id}', [TrainerWorkoutPlanController::class, 'destroy'])->name('workout_plans.destroy');

    // Clients & Chat
    Route::get('/clients', [TrainerClientController::class, 'index'])->name('clients.index');
    Route::get('/chat/{student}', [TrainerChatController::class, 'chat'])->name('chat');
});

// 🎓 Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard.student'))->name('dashboard');

    Route::get('/workout-plans', [StudentWorkoutPlanController::class, 'index'])->name('workout_plans.index');
    Route::get('/workout-plans/{id}', [StudentWorkoutPlanController::class, 'show'])->name('workout_plans.show');
    Route::post('/workout-plans/{id}/save', [StudentWorkoutPlanController::class, 'save'])->name('workout_plans.save');

    Route::get('/saved-data', [StudentController::class, 'savedData'])->name('saved.data');
});

// 👀 Trainer Profile (visible to students)
Route::middleware(['auth', 'role:student'])->get('/trainer/{trainer}/profile', [TrainerProfileController::class, 'show'])->name('trainer.profile');

// 🔐 Auth Scaffolding (Laravel Breeze, Fortify, Jetstream, etc.)
require __DIR__.'/auth.php';
