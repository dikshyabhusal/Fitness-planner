<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#1a1a2e] via-[#16213e] to-[#0f3460] text-white font-[Inter]">

        <!-- Hero Section -->
        <section class="relative w-full h-screen bg-cover bg-center flex items-center justify-center"
                 style="background-image: url('https://source.unsplash.com/1600x900/?fitness,training');">
            <div class="absolute inset-0 bg-black bg-opacity-70 backdrop-blur-md"></div>
            <div class="relative z-10 px-6 text-center max-w-4xl space-y-6 animate-fade-in">
                <h1 class="text-5xl sm:text-6xl font-[Poppins] font-extrabold leading-snug tracking-tight">
                    Transform Your Body with <br>
                    <span class="text-purple-400 text-6xl sm:text-7xl font-[Oswald] mt-2 block">Fitness Planner</span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-200 leading-relaxed max-w-2xl mx-auto">
                    Your all-in-one platform to build, track, and conquer your workout goals—where science meets sweat.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-4">
                    <a href="{{ route('login') }}"
                       class="px-8 py-3 text-lg font-semibold bg-white text-purple-800 rounded-full shadow-lg hover:bg-purple-100 transition duration-300">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-8 py-3 text-lg font-semibold bg-purple-700 text-white rounded-full shadow-lg hover:bg-purple-800 transition duration-300">
                        Get Started
                    </a>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="px-6 py-24 space-y-24 w-full">

            <!-- Info Section -->
            <section class="grid md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">
                <div class="space-y-6">
                    <h2 class="text-4xl font-extrabold text-purple-300">What is Workout Planner?</h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        <strong>Workout Planner</strong> is your digital fitness companion. It helps you create personalized fitness routines, track progress, learn correct form, and achieve your goals effectively.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-200">
                        <li class="flex items-start gap-2"><span>✅</span> Custom workout generator</li>
                        <li class="flex items-start gap-2"><span>✅</span> HD exercise tutorials</li>
                        <li class="flex items-start gap-2"><span>✅</span> Trainer-student sharing</li>
                        <li class="flex items-start gap-2"><span>✅</span> Smart body calculators</li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('storage/about.avif') }}" alt="Workout Info"
                         class="rounded-xl shadow-lg border-2 border-purple-500 max-w-md hover:scale-105 transition-transform">
                </div>
            </section>

            <!-- Categories Section -->
            <section class="max-w-7xl mx-auto text-center">
                <h2 class="text-4xl font-extrabold text-purple-300 mb-12">Workout Categories</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach([
                        ['title' => 'Bodybuilding', 'image' => 'body.jpeg', 'slug' => 'bodybuilding'],
                        ['title' => 'Fitness', 'image' => 'fitness.jpeg', 'slug' => 'fitness'],
                        ['title' => 'Cardio', 'image' => 'images.jpeg', 'slug' => 'cardio'],
                        ['title' => 'Pilates', 'image' => 'pilates.jpeg', 'slug' => 'pilates']
                    ] as $category)
                        <a href="{{ route('workout.show', $category['slug']) }}"
                           class="bg-white text-gray-900 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition block">
                            <img src="{{ asset('storage/welcome/' . $category['image']) }}" alt="{{ $category['title'] }}"
                                 class="w-full h-44 object-cover">
                            <div class="p-4 font-semibold text-xl">{{ $category['title'] }}</div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Workout Plans -->
            <section class="max-w-7xl mx-auto text-center py-12">
                <h2 class="text-4xl font-extrabold text-purple-300 mb-12">Popular Workout Plans</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($plans as $plan)
                        <div class="bg-white text-black rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold mb-2">{{ $plan->title }}</h3>
                                <p class="text-gray-600 line-clamp-3 mb-4">{{ $plan->description }}</p>
                            </div>

                            <!-- See Plan Button -->
                            <a href="{{ route('login') }}" 
                            class="mt-auto inline-block bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                                See Plan
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>



            <!-- Coaching Tips -->
            <section class="max-w-6xl mx-auto mt-10">
                <h3 class="text-4xl font-bold text-purple-300 mb-10 text-center">Trainer Tools & Coaching Tips</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-purple-100 bg-opacity-20 p-6 rounded-xl shadow hover:scale-105 transition">
                        <h4 class="text-2xl font-bold text-purple-200 mb-3">🧠 Beginner Coaching Guide</h4>
                        <ul class="list-disc list-inside text-purple-100 space-y-2">
                            <li>3x/week full-body plans</li>
                            <li>Form coaching with videos</li>
                            <li>Weekly assessments</li>
                        </ul>
                    </div>
                    <div class="bg-purple-100 bg-opacity-20 p-6 rounded-xl shadow hover:scale-105 transition">
                        <h4 class="text-2xl font-bold text-purple-200 mb-3">📈 Plan Structuring Tips</h4>
                        <ul class="list-disc list-inside text-purple-100 space-y-2">
                            <li>Use splits and recovery logic</li>
                            <li>Rotate focus areas weekly</li>
                            <li>Adjust with feedback</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Tools -->
            <section class="max-w-6xl mx-auto mt-20">
                <h3 class="text-4xl font-bold text-purple-300 mb-10 text-center">🔧 Tools You Can Use</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach([
                        ['title' => '📋 Client Progress Tracker', 'desc' => 'Log workouts, diets & weekly snapshots.'],
                        ['title' => '🧮 Fitness Calculators', 'desc' => 'Use BMI, BMR, calorie & rep max tools.'],
                        ['title' => '🎥 Exercise Video Library', 'desc' => 'Organized HD videos by goal/body part.'],
                        ['title' => '📊 Review & Feedback', 'desc' => 'Rate plans and read user reviews.'],
                    ] as $tool)
                        <div class="bg-white bg-opacity-90 p-6 rounded-xl text-purple-900 shadow hover:scale-105 transition">
                            <h4 class="text-xl font-semibold mb-2">{{ $tool['title'] }}</h4>
                            <p>{{ $tool['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- CTA -->
            <section class="text-center bg-purple-900 py-20 px-6 rounded-xl shadow-inner max-w-6xl mx-auto mt-20">
                <h2 class="text-4xl font-extrabold mb-4">Create Your Free Workout Plan Today</h2>
                <p class="text-gray-300 mb-6 text-lg">Use custom templates or start from scratch. It's free!</p>
                <a href="{{ route('register') }}"
                   class="px-10 py-4 bg-white text-purple-800 font-bold rounded-full shadow-xl hover:bg-purple-100 transition-transform transform hover:scale-105">
                    Get Started
                </a>
            </section>
            
            <section>
                @include('partials.testimonials-carousel')
            </section>

            <!-- Leave Review Form -->
            <section>
                @include('partials.testimonial-form')
            </section>
        </main>
    </div>

    <!-- Fade Animation -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out both;
        }
    </style>
</x-guest-layout>
