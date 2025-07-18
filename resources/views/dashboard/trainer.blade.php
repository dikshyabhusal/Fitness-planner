<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-100 via-purple-300 to-purple-600 px-4 sm:px-8 py-16 text-purple-900">
        <!-- Header Section -->
        <div class="max-w-6xl mx-auto text-center mb-16">
            <h1 class="text-5xl font-extrabold leading-tight text-purple-800 drop-shadow mb-4 animate__animated animate__zoomIn">Welcome {{ auth()->user()->name }}!</h1>
            <p class="text-lg text-purple-700">Empower your students with tailored workouts, track their progress, and access a library of top-tier fitness tools.</p>
        </div>

        <!-- Main Banner -->
        <div class="relative bg-cover bg-center rounded-2xl overflow-hidden shadow-xl mb-20" style="background-image: url('https://source.unsplash.com/1600x600/?fitness,training');">
            <div class="bg-purple-800 bg-opacity-70 w-full h-full p-10 flex flex-col justify-center text-center">
                <h2 class="text-4xl font-bold text-white mb-4 animate__animated animate__fadeInDown">All-in-One Coaching Dashboard</h2>
                <p class="text-purple-200 mb-6 animate__animated animate__fadeInUp">Access workout plans, calculators, progress tracking, and student feedback in one place.</p>
                <a href="#categories" class="bg-white text-purple-800 px-6 py-3 rounded-full font-semibold hover:bg-purple-200 transition">Explore Features</a>
            </div>
        </div>

        <!-- Workout Categories -->
        <section id="categories" class="max-w-6xl mx-auto py-16">
    <h3 class="text-3xl font-bold text-purple-900 mb-10 text-center">Workout Categories</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @php
            $categoryImages = [
                'Men' => 'storage/welcome/fitness.jpeg',
                'Women' => 'storage/welcome/fitness.jpeg',
                'Muscle Building' => 'storage/welcome/fitness.jpeg',
                'Fat Loss' => 'storage/welcome/fitness.jpeg',
                'Ab Workouts' => 'storage/welcome/fitness.jpeg',
                'Strength' => 'storage/welcome/fitness.jpeg',
                'Cardio' => 'storage/welcome/fitness.jpeg',
                'Beginner' => 'storage/welcome/fitness.jpeg',
                'At Home' => 'storage/welcome/fitness.jpeg',
                'Bodyweight' => 'storage/welcome/fitness.jpeg',
            ];
        @endphp
        @foreach($categoryImages as $category => $image)
        <div class="bg-white bg-opacity-70 p-4 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <img src="{{ asset($image) }}" class="rounded mb-3 w-full h-36 object-cover" alt="{{ $category }}">
            <h4 class="text-xl font-semibold text-purple-900">{{ $category }}</h4>
            <p class="text-sm text-purple-700 mt-1">Explore {{ $category }}-focused training plans.</p>
        </div>
        @endforeach
    </div>
</section>


        <!-- Tips and Advice -->
        <section class="max-w-6xl mx-auto mt-20">
            <h3 class="text-3xl font-bold text-purple-900 mb-10 text-center">Trainer Tools & Coaching Tips</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h4 class="text-2xl font-bold text-purple-800 mb-3">🧠 Beginner Coaching Guide</h4>
                    <ul class="list-disc list-inside text-purple-700 space-y-2">
                        <li>3x/week full-body plans for starters</li>
                        <li>Teach proper form with video demos</li>
                        <li>Weekly assessments & updates</li>
                    </ul>
                </div>
                <div class="bg-purple-200 bg-opacity-60 p-6 rounded-xl">
                    <h4 class="text-2xl font-bold text-purple-800 mb-3">📈 Plan Structuring Tips</h4>
                    <ul class="list-disc list-inside text-purple-700 space-y-2">
                        <li>Use push/pull splits & rest-day recovery</li>
                        <li>Rotate between cardio & strength days</li>
                        <li>Adapt plans by feedback loops</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Advanced Trainer Features -->
        <section class="max-w-6xl mx-auto mt-20">
            <h3 class="text-3xl font-bold text-purple-900 mb-10 text-center">🔧 Tools You Can Use</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white bg-opacity-80 p-6 rounded-xl">
                    <h4 class="text-xl font-semibold text-purple-900 mb-2">📋 Client Progress Tracker</h4>
                    <p class="text-purple-800">Log workouts, track diet compliance, and generate weekly improvement snapshots.</p>
                </div>
                <div class="bg-white bg-opacity-80 p-6 rounded-xl">
                    <h4 class="text-xl font-semibold text-purple-900 mb-2">🧮 Fitness Calculators</h4>
                    <p class="text-purple-800">Use BMI, calorie intake, grip strength, and rep max calculators with animated results.</p>
                </div>
                <div class="bg-white bg-opacity-80 p-6 rounded-xl">
                    <h4 class="text-xl font-semibold text-purple-900 mb-2">🎥 Exercise Video Library</h4>
                    <p class="text-purple-800">Upload high-quality videos categorized by body part and duration for easy client reference.</p>
                </div>
                <div class="bg-white bg-opacity-80 p-6 rounded-xl">
                    <h4 class="text-xl font-semibold text-purple-900 mb-2">📊 Review & Feedback</h4>
                    <p class="text-purple-800">View star ratings and comments from clients to refine plans and improve engagement.</p>
                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <div class="text-center mt-24 animate__animated animate__fadeInUp">
            <h3 class="text-3xl font-bold text-purple-800 mb-4">Start Building Your Next Plan</h3>
            <p class="text-purple-700 mb-6">Choose a goal-based template or begin creating a custom schedule from scratch.</p>
            <a href="{{ route('trainer.workout_plans.create') }}" class="bg-purple-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-purple-700 transition">Create Workout Plan</a>
        </div>
    </div>

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</x-app-layout>