<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#141e30] via-[#243b55] to-[#0f2027] py-16 px-6 text-white">

        <!-- Header -->
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h1 class="text-5xl font-extrabold tracking-tight mb-4 text-purple-300 animate__animated animate__fadeInDown">
                🚀 Welcome Back, {{ auth()->user()->name }}!
            </h1>
            <p class="text-lg text-gray-300 animate__animated animate__fadeInUp">
                Track your fitness journey, access exclusive plans, and level up with every session.
            </p>
        </div>

        <!-- Feature Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-7xl mx-auto">
            @php
                $features = [
                    [
                        'title' => '🏋️ My Workout Plans',
                        'desc' => 'View the customized workout routines assigned to you.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/833/833472.png',
                    ],
                    [
                        'title' => '🥗 My Diet Plan',
                        'desc' => 'Follow your personalized meal schedule to meet your goals.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/1046/1046784.png',
                    ],
                    [
                        'title' => '🎥 Watch Workout Videos',
                        'desc' => 'Learn the proper form and techniques from our video library.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/2910/2910768.png',
                    ],
                    [
                        'title' => '❤️ Saved Workout Plans',
                        'desc' => 'View workout plans you bookmarked for future use.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/2589/2589175.png',
                    ],
                    [
                        'title' => '🍽️ Saved Diet Plans',
                        'desc' => 'Find the meal plans you saved for easy access.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/2921/2921823.png',
                    ],
                    [
                        'title' => '👤 My Trainer',
                        'desc' => 'See trainer details, ratings, and get in touch.',
                        'link' => route('videos.index'),
                        'icon' => 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                    ],
                ];
            @endphp

            @foreach ($features as $item)
                <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-3xl p-6 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }} Icon" class="w-16 h-16 mb-4">
                        <h3 class="text-xl font-bold text-purple-200 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-300 mb-4">{{ $item['desc'] }}</p>
                        <a href="{{ $item['link'] }}" class="bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">Explore</a>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</x-app-layout>
