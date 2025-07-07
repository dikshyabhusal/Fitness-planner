<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-orange-400 to-purple-600 py-12 px-4 sm:px-6 lg:px-8 text-white">
        

        <div class="max-w-7xl mx-auto">
            
            <h1 class="text-4xl font-extrabold text-center mb-4">Student Dashboard</h1>
            <p class="text-center text-orange-100 mb-10 text-lg">Track your workouts, follow plans, and stay on top of your fitness journey.</p>
            {{-- <h3>Day {{ $today }}</h3>
            <ul>
            <li>
                <input type="checkbox" wire:model="workout_done"> ✅ Workout Done
            </li>
            <li>
                <input type="checkbox" wire:model="diet_done"> 🍎 Diet Followed
            </li>
            </ul> --}}

            <!-- Student Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Workout Plans -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">My Workout Plans</h2>
                    <p class="text-sm text-orange-100">See the workout routines assigned to you by your trainer.</p>
                    <a href="{{route('student.workout_plans.index')}}" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">View Plans →</a>
                </div>

                <!-- Diet Plans -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">My Diet Plan</h2>
                    <p class="text-sm text-orange-100">Follow your personalized nutrition plan to stay healthy and fit.</p>
                    <a href="#" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">View Diet →</a>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Progress Tracking</h2>
                    <p class="text-sm text-orange-100">Log your workout data, weight, and track daily achievements.</p>
                    <a href="#" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">Track Progress →</a>
                </div>

                <!-- Messages -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Trainer Messages</h2>
                    <p class="text-sm text-orange-100">Check messages, tips, and session updates from your trainer.</p>
                    <a href="#" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">Go to Inbox →</a>
                </div>

                <!-- Book a Session -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Book a Session</h2>
                    <p class="text-sm text-orange-100">Need extra help? Book a 1-on-1 session with your trainer.</p>
                    <a href="#" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">Book Now →</a>
                </div>

                <!-- Feedback -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Give Feedback</h2>
                    <p class="text-sm text-orange-100">Tell us how your training is going. Your feedback matters!</p>
                    <a href="#" class="mt-4 inline-block text-orange-200 hover:text-white font-medium">Send Feedback →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
