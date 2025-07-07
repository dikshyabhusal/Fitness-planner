\<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 space-y-10">

        <!-- 🏋️‍♂️ Workout Plan Header -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-3xl font-bold text-purple-700 mb-2">{{ $plan->title }}</h2>
            <p class="text-gray-600 mb-1">
                By:
                <a href="{{ route('trainer.profile', $plan->trainer->id) }}"
                   class="text-purple-600 hover:underline font-semibold">
                    {{ $plan->trainer->name }}
                </a>
                |
                Duration: {{ $plan->duration_days }} days
            </p>

            <form action="{{ route('student.workout_plans.save', $plan->id) }}" method="POST" class="mt-4">
                @csrf
                <button class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-md font-medium">
                    💾 Save Workout
                </button>
            </form>
        </div>

        <!-- 📅 Workout Calendar -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-purple-700 mb-4">📅 Workout Calendar</h3>
            <livewire:student-workout-calendar :planId="$plan->id" />
        </div>

        <!-- 🏃‍♂️ Workout Days -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-purple-700 mb-4">💪 Workout Plan Days</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($plan->days as $day)
                    <div class="p-4 border border-purple-200 rounded bg-gray-50">
                        <h4 class="font-semibold text-purple-600">Day {{ $day->day_number }}</h4>
                        <p class="text-sm text-gray-700">{{ $day->title }}</p>
                        <p class="text-xs text-gray-500">{{ $day->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 🥗 Diet Plan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-purple-700 mb-4">🥗 Diet Plan (7-Day Base)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($diet as $day => $meals)
                    <div class="p-4 border bg-white rounded">
                        <h4 class="font-semibold text-purple-600 mb-2">Day {{ $day }}</h4>
                        @foreach($meals as $meal)
                            <p>
                                <span class="font-medium capitalize">{{ $meal->meal_time }}:</span>
                                {{ $meal->meal }}
                            </p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 🧾 Daily Progress Tracker -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-purple-700 mb-4">📌 Track Your Daily Progress</h3>
            <livewire:student-progress :planId="$plan->id" />
        </div>

        <!-- 📈 Progress Report Button -->
        <div class="text-center">
            <a href="{{ route('student.progress.report', $plan->id) }}"
               class="inline-block mt-6 bg-purple-700 hover:bg-purple-800 text-white px-6 py-3 rounded-lg font-semibold">
                📊 View Progress Report
            </a>
        </div>

    </div>
</x-app-layout>
