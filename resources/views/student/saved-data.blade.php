<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-purple-700">📌 Your Saved Workouts</h1>

        @if($savedWorkouts->isEmpty())
            <div class="text-gray-500 text-center p-6">
                You haven’t saved any workout plans yet.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($savedWorkouts as $plan)
                    <div class="border rounded-lg shadow-sm p-5 bg-gradient-to-r from-purple-100 to-purple-50 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $plan->title }}</h2>
                        <p class="text-sm text-gray-600 mt-2">
                            {{ Str::limit($plan->description ?? 'No description available.', 100) }}
                        </p>
                        <a href="{{ route('student.workout_plans.show', $plan->id) }}"
                           class="inline-block mt-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                            View Plan
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
