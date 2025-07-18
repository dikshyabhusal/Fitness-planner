<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10">

        <!-- PLAN INFO -->
        <div class="bg-white p-6 rounded-2xl shadow-lg mb-10 border-l-8 border-purple-500">
            <h2 class="text-4xl font-extrabold text-purple-700 mb-2">{{ $plan->title }}</h2>
            <p class="text-sm text-gray-500 mb-1">👤 Trainer: <strong>{{ $plan->trainer->name }}</strong></p>
            <p class="text-gray-700 mb-4 italic">{{ $plan->description }}</p>
            <p class="text-sm text-gray-600">🕒 Duration: <strong>{{ $plan->duration_days }} days</strong> | Gender: <strong>{{ ucfirst($plan->gender) }}</strong></p>
        </div>

        <!-- WORKOUT SCHEDULE -->
        <h3 class="text-3xl font-semibold text-purple-700 mb-4">📅 Workout Schedule</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            @foreach($plan->days->take(6) as $day)

                <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-4 rounded-xl shadow-md hover:shadow-lg transition">
                    <h4 class="font-bold text-purple-800">Day {{ $day->day_number }}</h4>
                    <p class="text-sm text-gray-800 font-medium mt-1">{{ $day->title }}</p>
                    <p class="text-xs text-gray-600 italic mt-1">{{ $day->description }}</p>
                </div>
            @endforeach
        </div>

        <!-- DIET PLAN -->
        <h3 class="text-3xl font-semibold text-green-700 mb-4">🍽️ Diet Plan (7-Day Base)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            @foreach($diet as $day => $meals)
                <div class="p-4 bg-white border-l-4 border-green-400 rounded-xl shadow-md">
                    <h4 class="font-bold text-green-700 mb-2">Day {{ $day }}</h4>
                    @foreach($meals as $meal)
                        <p class="text-sm text-gray-800 mb-1">
                            <span class="font-semibold capitalize">{{ $meal->meal_time }}:</span>
                            {{ $meal->meal }}
                        </p>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- STUDENT REVIEWS SECTION -->
        <h3 class="text-3xl font-semibold text-yellow-700 mb-4">⭐ Student Reviews</h3>

        @forelse ($plan->reviews as $review)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded p-4 mb-4 shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ $review->student->name }} reviewed:
                        <span class="text-yellow-600 font-bold">{{ $review->rating }}/5 ⭐</span>
                    </p>
                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                </div>
                <p class="mt-2 text-gray-700 italic">"{{ $review->comment }}"</p>
            </div>
        @empty
            <p class="text-gray-500 italic">No reviews yet from students.</p>
        @endforelse

        <!-- ACTION BUTTONS -->
        <div class="flex justify-end space-x-4 mt-10">
            <a href="{{ route('trainer.workout_plans.edit', $plan->id) }}"
               class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 transition">
                ✏️ Edit
            </a>

            <form action="{{ route('trainer.workout_plans.destroy', $plan->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this plan?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-gradient-to-r from-red-500 to-red-700 text-white px-5 py-2 rounded-lg shadow hover:scale-105 transition">
                    🗑️ Delete
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
