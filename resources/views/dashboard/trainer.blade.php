<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-100 via-purple-300 to-purple-600 px-4 sm:px-8 py-16 text-purple-900 font-[Inter]">

        <!-- Welcome Header -->
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h1 class="text-5xl font-extrabold text-purple-800 mb-4 animate__animated animate__fadeInDown">
                Welcome, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-lg text-purple-700">Manage your training empire: plans, progress, nutrition & media — all in one place.</p>
        </div>

        <!-- Quick Action Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto mb-20">
            @foreach ([
                ['title' => 'Create Workout Plan', 'icon' => '🏋️', 'route' => 'trainer.workout_plans.create'],
                ['title' => 'Upload Exercise Video', 'icon' => '🎥', 'route' => 'videos.create'],
                ['title' => 'Create Diet Plan', 'icon' => '🥗', 'route' => 'diet.step1.form'],
                // ['title' => 'Check Progress', 'icon' => '📊', 'route' => 'trainer.progress.overview'],
            ] as $card)
                <a href="{{ route($card['route']) }}"
                   class="bg-white bg-opacity-80 p-6 rounded-xl text-center shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="text-5xl mb-4">{{ $card['icon'] }}</div>
                    <h3 class="text-xl font-bold text-purple-800">{{ $card['title'] }}</h3>
                </a>
            @endforeach
        </section>

        <!-- Workout Categories -->
        <section class="max-w-7xl mx-auto mb-20">
            <h2 class="text-3xl font-bold text-purple-900 mb-10 text-center">Your Workout Library</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach(['Strength', 'Cardio', 'Flexibility', 'Endurance', 'HIIT', 'Yoga'] as $type)
                    <div class="bg-white bg-opacity-70 p-4 rounded-xl shadow hover:shadow-lg transition">
                        <h4 class="text-xl font-semibold text-purple-900">{{ $type }}</h4>
                        <p class="text-sm text-purple-700 mt-1">Create or manage {{ strtolower($type) }} workouts.</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Features Overview -->
        <section class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-purple-900 mb-10 text-center">Trainer Dashboard Tools</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold text-purple-800 mb-3">📈 Smart Progress Tracker</h3>
                    <p class="text-purple-700">Monitor students' workout & diet completion. Generate visual reports & insights.</p>
                </div>
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold text-purple-800 mb-3">🍽️ Custom Diet Planner</h3>
                    <p class="text-purple-700">Design nutrition plans by body type, goal, or fitness program. View diet charts.</p>
                </div>
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold text-purple-800 mb-3">🎥 Media Library</h3>
                    <p class="text-purple-700">Upload, organize and attach exercise videos by muscle group or category.</p>
                </div>
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold text-purple-800 mb-3">🔔 Student Notifications</h3>
                    <p class="text-purple-700">Send reminders, updates and motivational messages in real-time.</p>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <div class="text-center mt-24 animate__animated animate__fadeInUp">
            <h3 class="text-3xl font-bold text-purple-800 mb-4">Ready to Coach Smarter?</h3>
            <p class="text-purple-700 mb-6">Use all features to train, connect, and grow your fitness network.</p>
            <a href="{{ route('trainer.workout_plans.create') }}" class="bg-purple-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-purple-700 transition">
                Start a New Workout Plan
            </a>
        </div>

    </div>

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</x-app-layout>
