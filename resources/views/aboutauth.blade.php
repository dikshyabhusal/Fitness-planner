
<x-app-layout>
<!-- About Section -->
<section id="about" class="bg-gradient-to-r from-[#1a1a2e] via-[#16213e] to-[#0f3460] py-20 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <!-- Text -->
        <div class="text-white space-y-6">
            <h2 class="text-4xl font-bold text-purple-400">About Fitness Planner</h2>
            <p class="text-gray-300 text-lg leading-relaxed">
                Fitness Planner is your personal workout companion — designed for beginners, fitness enthusiasts, and professional trainers. Whether you're training at home or in the gym, our platform helps you build smart routines, follow guided programs, and track progress.
            </p>
            <ul class="list-disc pl-6 text-gray-400">
                <li>Create & customize your workout plans</li>
                <li>Access exercise tutorials with videos/images</li>
                <li>Track progress & share plans with trainers</li>
                <li>Discover goals like weight loss, muscle gain, and endurance</li>
            </ul>
            {{-- <a href="{{ route('register') }}" class="inline-block mt-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                Get Started Free
            </a> --}}
        </div>

        <!-- Image -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/about.avif') }}" alt="About Fitness" class="rounded-xl shadow-2xl border-4 border-purple-500">
        </div>

    </div>
</section>
</x-app-layout>
