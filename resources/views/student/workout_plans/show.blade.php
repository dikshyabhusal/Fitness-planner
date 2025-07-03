<x-app-layout>
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">{{ $plan->title }}</h2>
    <p class="text-gray-700 mb-2">By: {{ $plan->trainer->name }} | Duration: {{ $plan->duration_days }} days</p>
    <p class="mb-6">{{ $plan->description }}</p>

    <form action="{{ route('student.workout_plans.save', $plan->id) }}" method="POST" class="mb-6">
        @csrf
        <button class="bg-purple-600 text-white px-4 py-2 rounded">💾 Save Workout</button>
    </form>

    {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($plan->days as $day)
        <div class="p-4 border rounded shadow">
            <h4 class="font-bold">Day {{ $day->day_number }}</h4>
            <p class="text-sm text-gray-700">{{ $day->title }}</p>
            <p class="text-xs text-gray-500">{{ $day->description }}</p>
        </div>
        @endforeach
    </div> --}}
    <!-- Exercise Days -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
    @foreach($plan->days as $day)
        <div class="p-4 border rounded shadow bg-white">
            <h4 class="font-bold text-purple-700">Day {{ $day->day_number }}</h4>
            <p class="text-sm text-gray-700">{{ $day->title }}</p>
            <p class="text-xs text-gray-500">{{ $day->description }}</p>
        </div>
    @endforeach
</div>

<!-- Diet Plan Section -->
<h3 class="text-2xl font-bold mb-4">Diet Plan (7-Day Base)</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($diet as $day => $meals)
        <div class="p-4 border bg-gray-50 rounded shadow">
            <h4 class="font-bold text-purple-700 mb-2">Day {{ $day }}</h4>
            @foreach($meals as $meal)
                <p><span class="font-semibold capitalize">{{ $meal->meal_time }}:</span> {{ $meal->meal }}</p>
            @endforeach
        </div>
    @endforeach
</div>

</div>
</x-app-layout>

