<x-app-layout>
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-6">Workout Plans</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($plans as $plan)
        <div class="bg-white p-4 border rounded shadow">
            <h3 class="text-xl font-semibold">{{ $plan->title }}</h3>
            <p class="text-sm text-gray-500">By: {{ $plan->trainer->name }}</p>
            <p>Duration: {{ $plan->duration_days }} days</p>
            <p>For: {{ ucfirst($plan->gender) }}</p>
            <a href="{{ route('student.workout_plans.show', $plan->id) }}" class="text-blue-600 mt-2 inline-block">View Plan</a>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>

