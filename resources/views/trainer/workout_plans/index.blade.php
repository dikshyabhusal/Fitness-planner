<x-app-layout>
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-extrabold text-purple-700">📋 My Workout Plans</h2>
        <a href="{{ route('trainer.workout_plans.create') }}"
           class="bg-purple-600 hover:bg-lightpurple-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            + Add New Plan
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <div class="plan-card bg-white p-5 rounded-2xl shadow-md border hover:shadow-xl transition duration-300" data-tilt>
                <h3 class="text-2xl font-bold text-purple-800 mb-2">{{ $plan->title }}</h3>
                <p class="text-sm text-gray-600 mb-3">🕒 Duration: <strong>{{ $plan->duration_days }} days</strong></p>
                <p class="text-sm text-gray-600 mb-4">👤 For: <strong>{{ ucfirst($plan->gender) }}</strong></p>

                <a href="{{ route('trainer.workout_plans.show', $plan->id) }}"
                   class="inline-block text-blue-600 font-medium hover:underline transition">
                    👁️ View Full Plan
                </a>
            </div>
        @empty
            <p class="text-gray-500 italic">You haven’t added any workout plans yet.</p>
        @endforelse
    </div>
</div>

<!-- VanillaTilt JS for animation -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".plan-card"), {
        max: 15,
        speed: 300,
        glare: true,
        "max-glare": 0.3,
    });
</script>
</x-app-layout>
