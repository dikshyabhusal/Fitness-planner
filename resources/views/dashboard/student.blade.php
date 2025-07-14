<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#0f2027] via-[#203a43] to-[#2c5364] py-16 px-6 text-white">

        <div class="max-w-7xl mx-auto text-center mb-14">
            <h1 class="text-5xl font-extrabold tracking-tight mb-4">🎯 Welcome Back, Champion!</h1>
            <p class="text-gray-200 text-lg">Your fitness journey starts here. Access your routines, meals, and track your victories — all in one place.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @php
                $features = [
                    [
                        'title' => '🏋️ Workout Plans',
                        'desc' => 'Tailored exercises and weekly routines from your trainer.',
                        'link' => route('student.workout_plans.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/833/833472.png',
                    ],
                    [
                        'title' => '🥗 Diet Guidance',
                        'desc' => 'Track your daily nutrition plans and meal macros.',
                        'link' => '#',
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/1046/1046784.png',
                    ],
                    [
                        'title' => '📊 Progress Tracker',
                        'desc' => 'Visualize your weight loss, strength gains, and more.',
                        'link' => '#',
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/1828/1828919.png',
                    ],
                    [
                        'title' => '📩 Trainer Messages',
                        'desc' => 'Chat or read messages sent by your assigned trainer.',
                        'link' => '#',
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/893/893257.png',
                    ],
                    [
                        'title' => '📅 Calendar View',
                        'desc' => 'Mark completed workouts and upcoming sessions.',
                        'link' => '#',
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/747/747310.png',
                    ],
                    [
                        'title' => '🧠 AI Recommendations',
                        'desc' => 'Plans and meals curated based on your habits.',
                        'link' => '#',
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/3103/3103446.png',
                    ],
                ];
            @endphp

            @foreach ($features as $item)
                <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-3xl p-6 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center">
                        <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }} Icon" class="w-16 h-16 mb-4">
                        <h3 class="text-xl font-bold mb-2 text-white">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-300 mb-4">{{ $item['desc'] }}</p>
                        <a href="{{ $item['link'] }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-full hover:bg-purple-700 transition">Go</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
