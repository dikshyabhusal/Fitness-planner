<x-app-layout>
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">My Workout Plans</h2>
    <a href="{{ route('trainer.workout_plans.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded">+ Add New Plan</a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($plans as $plan)
            {{-- <div class="border p-4 rounded shadow bg-white">
                <h3 class="text-xl font-bold">{{ $plan->title }}</h3>
                <p class="text-gray-600">Duration: {{ $plan->duration_days }} days | Gender: {{ ucfirst($plan->gender) }}</p>
            </div> --}}
            <div class="border p-4 rounded shadow bg-white">
        <h3 class="text-xl font-bold">{{ $plan->title }}</h3>
        <p class="text-gray-600">Duration: {{ $plan->duration_days }} days | Gender: {{ ucfirst($plan->gender) }}</p>

        <a href="{{ route('trainer.workout_plans.show', $plan->id) }}" class="mt-2 inline-block text-blue-600 hover:underline">
            👁️ View Full Plan
        </a>
    </div>
        @endforeach
    </div>
</div>
</x-app-layout>

