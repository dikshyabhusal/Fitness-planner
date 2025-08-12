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
use App\Http\Controllers\Student\ProgressReportController;
use App\Http\Controllers\DietCategoryController;
use App\Http\Controllers\UserDietPlanController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\BMIController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExerciseVideoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\TrainerProgressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\TrainerWorkoutController;


// 🏠 Public Pages
Route::get('/', fn () => view('welcome'))->name('home');

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

Route::middleware(['auth', 'role:student'])->get('/student/progress-report/{plan}', [ProgressReportController::class, 'show'])->name('student.progress.report');
Route::get('/diet-categories', [DietCategoryController::class, 'index'])->name('diet.categories');
Route::get('/diet-categories/{id}', [DietCategoryController::class, 'show'])->name('diet.category.show');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/diet/create', [DietCategoryController::class, 'create'])->name('diet.create');
//     Route::post('/diet/store', [DietCategoryController::class, 'store'])->name('diet.store');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/diet/create', [UserDietPlanController::class, 'index'])->name('diet.user.form');
//     Route::post('/diet/create', [UserDietPlanController::class, 'store'])->name('diet.user.store');
// });
// <?php


// use App\Http\Controllers\UserDietPlanController;

Route::middleware(['auth'])->group(function () {
    // Step 1: Select Goal & Target
    Route::get('/diet/create-step1', [UserDietPlanController::class, 'stepOneForm'])->name('diet.step1.form');
    Route::post('/diet/create-step1', [UserDietPlanController::class, 'storeStepOne'])->name('diet.step1.store');
// Route::get('/diet/{category}', [UserDietPlanController::class, 'showCategory'])->name('diet.show');

    // Step 2: Enter Meal Plan
    Route::get('/diet/create-step2/{category}', [UserDietPlanController::class, 'stepTwoForm'])->name('diet.step2.form');
    Route::post('/diet/create-step2/{category}', [UserDietPlanController::class, 'storeStepTwo'])->name('diet.step2.store');
    // Route to show a single diet plan by its id or slug (whatever your identifier is)
    // Route::get('/diet/{userDietPlan}', [UserDietPlanController::class, 'show'])->name('diet.show');
    Route::get('/diet-categories', [UserDietPlanController::class, 'categories'])->name('diet.categories');
Route::get('/diet-categories/{id}', [UserDietPlanController::class, 'categoryPlans'])->name('diet.category.plans');
Route::get('/diet-plans/{dietPlan}', [UserDietPlanController::class, 'showPlan'])->name('diet.show');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/recommend-diet', [RecommendationController::class, 'form'])->name('diet.recommend.form');
    Route::post('/recommend-diet', [RecommendationController::class, 'recommend'])->name('diet.recommend');
    Route::get('/diet-plan/{category_id}', [RecommendationController::class, 'show'])->name('diet.recommend.show');
    Route::post('/diet/{id}/bookmark', [RecommendationController::class, 'bookmark'])->middleware('auth')->name('diet.bookmark');

});


Route::prefix('calculator')->group(function () {
    Route::get('/bmi', [BMIController::class, 'bmi'])->name('calculator.bmi');
    Route::post('/bmi', [BMIController::class, 'bmiCalculate'])->name('calculator.bmi.calculate');

    Route::get('/body-fat', [BMIController::class, 'bodyFat'])->name('calculator.bodyFat');
    Route::post('/body-fat', [BMIController::class, 'bodyFatCalculate'])->name('calculator.bodyFat.calculate');

    Route::get('/calories-burned', [BMIController::class, 'caloriesBurned'])->name('calculator.caloriesBurned');
    Route::post('/calories-burned', [BMIController::class, 'caloriesBurnedCalculate'])->name('calculator.caloriesBurned.calculate');

    Route::get('/daily-calorie', [BMIController::class, 'dailyCalorie'])->name('calculator.dailyCalorie');
    Route::post('/daily-calorie', [BMIController::class, 'dailyCalorieCalculate'])->name('calculator.dailyCalorie.calculate');

    Route::get('/one-rep-max', [BMIController::class, 'oneRepMax'])->name('calculator.oneRepMax');
    Route::post('/one-rep-max', [BMIController::class, 'oneRepMaxCalculate'])->name('calculator.oneRepMax.calculate');

    Route::get('/grip-strength', [BMIController::class, 'gripStrength'])->name('calculator.gripStrength');
    Route::post('/grip-strength', [BMIController::class, 'gripStrengthCalculate'])->name('calculator.gripStrength.calculate');
});
Route::middleware(['auth', 'role:trainer'])->group(function () {
    Route::get('/videos/create', [ExerciseVideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [ExerciseVideoController::class, 'store'])->name('videos.store');
});

Route::middleware(['auth','role:student'])->group(function () {
    Route::get('/videos', [ExerciseVideoController::class, 'index'])->name('videos.index');
});
Route::middleware(['auth', 'role:student'])->post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::view('/privacy-policy', 'privacy')->name('privacy.policy');



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/workouts', [AdminDashboardController::class, 'workouts'])->name('workouts');
    Route::get('/diets', [AdminDashboardController::class, 'diets'])->name('diets');
    Route::get('/reviews', [AdminDashboardController::class, 'reviews'])->name('reviews');
    Route::get('/contacts/view', [AdminDashboardController::class, 'contacts'])->name('contacts');
    Route::put('/users/{id}/role', [AdminDashboardController::class, 'updateRole'])->name('updateRole');
});

Route::middleware(['auth', 'role:trainer'])->group(function () {
    Route::get('/trainer/progress', [TrainerProgressController::class, 'index'])->name('trainer.progress.overview');
    Route::get('/trainer/progress/{student}', [TrainerProgressController::class, 'show'])->name('trainer.progress.student');
});


Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::resource('products', ProductController::class);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
});

Route::middleware(['auth','role:student'])->group(function(){
    Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders/create/{product}', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/{order}/invoice', [OrderController::class, 'invoice'])->name('order.invoice');
    Route::post('/order/{order}/pay', [OrderController::class, 'pay'])->name('order.pay');
    // optional PDF download (requires barryvdh/laravel-dompdf)
    Route::get('/order/{order}/invoice/download', [OrderController::class, 'downloadInvoice'])->name('order.invoice.download');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{order}', [OrderController::class, 'myOrderDetails'])->name('orders.my.details');
});


// routes/web.php
Route::prefix('trainer')->name('trainer.')->middleware(['auth','role:trainer'])->group(function () {
    Route::get('/workouts', [TrainerWorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/workouts/{id}/progress', [TrainerWorkoutController::class, 'progress'])->name('workouts.progress');
});

// 🔐 Auth Scaffolding (Laravel Breeze, Fortify, Jetstream, etc.)
require __DIR__.'/auth.php';
