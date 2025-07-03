<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10">

        <!-- Plan Info -->
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-3xl font-bold text-purple-700 mb-2">{{ $plan->title }}</h2>
            <p class="text-sm text-gray-500 mb-2">By: {{ $plan->trainer->name }}</p>
            <p class="text-gray-700 mb-4">{{ $plan->description }}</p>
            <p class="text-sm text-gray-600">Duration: {{ $plan->duration_days }} days | Gender: {{ ucfirst($plan->gender) }}</p>
        </div>

        <!-- Exercise Days -->
        <h3 class="text-2xl font-semibold text-purple-700 mb-4">Workout Schedule</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @foreach($plan->days as $day)
                <div class="p-4 border rounded shadow bg-gray-50">
                    <h4 class="font-bold text-purple-600">Day {{ $day->day_number }}</h4>
                    <p class="text-sm text-gray-800">{{ $day->title }}</p>
                    <p class="text-xs text-gray-600">{{ $day->description }}</p>
                </div>
            @endforeach
        </div>

        <!-- Diet Plan -->
        <h3 class="text-2xl font-semibold text-purple-700 mb-4">Diet Plan (7-Day Base)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            @foreach($diet as $day => $meals)
                <div class="p-4 border bg-white rounded shadow">
                    <h4 class="font-bold text-purple-600 mb-2">Day {{ $day }}</h4>
                    @foreach($meals as $meal)
                        <p class="text-sm text-gray-800">
                            <span class="font-semibold capitalize">{{ $meal->meal_time }}:</span>
                            {{ $meal->meal }}
                        </p>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Edit & Delete Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('trainer.workout_plans.edit', $plan->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                ✏️ Edit
            </a>

            <form action="{{ route('trainer.workout_plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    🗑️ Delete
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
