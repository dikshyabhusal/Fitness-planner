<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkoutController;


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


// Breeze auth routes
require __DIR__.'/auth.php';
