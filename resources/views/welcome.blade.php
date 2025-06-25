<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#1a1a2e] via-[#16213e] to-[#0f3460] text-white">
        <!-- Hero Section -->
        <section class="w-full h-screen flex flex-col items-center justify-center text-center bg-cover bg-center relative"
                 style="background-image: url('https://source.unsplash.com/1600x900/?fitness,workout');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="relative z-10 px-4">
                <h1 class="text-5xl font-bold sm:text-6xl mb-6 leading-tight">
                    Welcome to <span class="text-purple-400">Fitness Planner</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 mb-8">
                    Track workouts. Learn techniques. Plan your fitness journey – all in one place.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-purple-800 font-semibold rounded-md shadow hover:bg-purple-100 transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-purple-600 font-semibold rounded-md shadow hover:bg-purple-700 transition duration-300">Register</a>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="px-6 py-20 space-y-24 w-full">
            <!-- Info Section -->
            <section class="grid md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">
                <div class="space-y-5">
                    <h2 class="text-3xl font-bold text-purple-300">What is Workout Planner?</h2>
                    <p class="text-gray-300 text-lg">
                        A web-based app to create your own personalized fitness plan based on your equipment and preferences.
                        Whether you're a beginner or a pro – we’ve got you covered!
                    </p>
                    <ul class="list-disc list-inside text-gray-400 space-y-1">
                        <li>Free custom workout creator</li>
                        <li>Exercise tutorials with images</li>
                        <li>Trainer & student workout sharing</li>
                        <li>Smart fitness calculators</li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <img src="https://source.unsplash.com/600x400/?workout,training" alt="Workout Info" class="rounded-xl shadow-lg border-2 border-purple-500">
                </div>
            </section>

            <!-- Categories Section -->
            <section class="max-w-7xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-purple-300 mb-10">Workout Categories</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @php
                        $categories = [
                            [
                                'title' => 'Bodybuilding',
                                'image' => asset('storage/welcome/body.jpeg'),
                                'slug'  => 'bodybuilding',
                            ],
                            [
                                'title' => 'Fitness',
                                'image' => asset('storage/welcome/fitness.jpeg'),
                                'slug'  => 'fitness',
                            ],
                            [
                                'title' => 'Cardio',
                                'image' => asset('storage/welcome/images.jpeg'),
                                'slug'  => 'cardio',
                            ],
                            [
                                'title' => 'Pilates',
                                'image' => asset('storage/welcome/pilates.jpeg'),
                                'slug'  => 'pilates',
                            ],
                        ];
                    @endphp

                    @foreach($categories as $category)
                        <!-- ✅ UPDATED: Made the card clickable -->
                        <a href="{{ route('workout.show', $category['slug']) }}" class="block hover:cursor-pointer">
                            <div class="bg-white text-gray-900 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
                                <img src="{{ $category['image'] }}" alt="{{ $category['title'] }}" class="w-full h-40 object-cover">
                                <div class="p-4 text-lg font-semibold text-center">{{ $category['title'] }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Workout Plans Section -->
            <section class="max-w-7xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-purple-300 mb-10">Popular Workout Plans</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $plans = [
                            ['title' => '6-Month Bodybuilding Program', 'goal' => 'Build Muscle'],
                            ['title' => '3x5 Full Body Strength', 'goal' => 'Build Strength'],
                            ['title' => 'Body Toning for Women', 'goal' => 'Build Muscle, Lose Fat'],
                        ];
                    @endphp
                    @foreach($plans as $plan)
                        <div class="bg-white text-black rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300">
                            <h3 class="text-xl font-bold mb-2">{{ $plan['title'] }}</h3>
                            <p class="text-gray-600">{{ $plan['goal'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Call to Action -->
            <section class="text-center bg-purple-950 py-16 px-6 rounded-xl shadow-inner max-w-6xl mx-auto">
                <h2 class="text-4xl font-extrabold mb-4">Create Your Free Workout Plan Now</h2>
                <p class="text-gray-300 mb-6">Build your own plan or use our free templates to achieve your goals!</p>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-purple-700 text-white font-bold rounded-full shadow-lg hover:bg-purple-800 transition duration-300">Get Started</a>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-[#0f1b2e] py-8 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} FitLife Planner. All rights reserved.</p>
            <p>Contact us: <a href="mailto:mail@fitnessprogramer.com" class="underline hover:text-purple-300">mail@fitnessprogramer.com</a></p>
        </footer>
    </div>
</x-guest-layout>
