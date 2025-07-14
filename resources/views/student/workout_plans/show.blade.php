<x-app-layout>
    <div class="max-w-6xl mx-auto mt-12 space-y-12 px-4">

        <!-- 🏋️‍♂️ Workout Plan Header -->
        <div class="bg-gradient-to-r from-purple-100 via-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6 shadow">
            <h2 class="text-4xl font-extrabold text-purple-800 mb-3">{{ $plan->title }}</h2>
            <p class="text-gray-700 text-lg mb-2">
                By
                <a href="{{ route('trainer.profile', $plan->trainer->id) }}"
                   class="text-purple-600 hover:underline font-semibold">
                    {{ $plan->trainer->name }}
                </a>
                | Duration: <span class="font-semibold">{{ $plan->duration_days }} days</span>
            </p>

            <form action="{{ route('student.workout_plans.save', $plan->id) }}" method="POST" class="mt-3">
                @csrf
                <button class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg font-medium shadow transition">
                    💾 Save Workout Plan
                </button>
            </form>
        </div>

        <!-- 📅 Workout Calendar -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-300">
            <h3 class="text-2xl font-bold text-purple-700 mb-4 flex items-center gap-2">📅 Workout Calendar</h3>
            <livewire:student-workout-calendar :planId="$plan->id" />
        </div>

        <!-- 💪 Workout Days -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-300">
            <h3 class="text-2xl font-bold text-purple-700 mb-6">💪 Workout Plan Days</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($plan->days as $day)
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 hover:shadow-lg transition">
                        <h4 class="text-lg font-semibold text-purple-800 mb-1">Day {{ $day->day_number }}</h4>
                        <p class="text-sm text-gray-800">{{ $day->title }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $day->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 🥗 Diet Plan -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-400">
            <h3 class="text-2xl font-bold text-green-700 mb-6">🥗 Diet Plan (7-Day Base)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($diet as $day => $meals)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-700 text-lg mb-2">Day {{ $day }}</h4>
                        @foreach($meals as $meal)
                            <p class="text-sm text-gray-800">
                                <span class="font-medium capitalize">{{ $meal->meal_time }}:</span>
                                {{ $meal->meal }}
                            </p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 🧾 Daily Progress Tracker -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-400">
            <h3 class="text-2xl font-bold text-blue-700 mb-4">📌 Track Your Daily Progress</h3>
            <livewire:student-progress :planId="$plan->id" />
        </div>

        <!-- 📈 Progress Report Button -->
        <div class="text-center">
            <a href="{{ route('student.progress.report', $plan->id) }}"
               class="inline-block mt-8 bg-purple-700 hover:bg-purple-800 text-white px-4 py-3 rounded-xl font-semibold shadow-lg transition">
                📊 View Full Progress Report
            </a>
        </div>

    </div>
</x-app-layout>
