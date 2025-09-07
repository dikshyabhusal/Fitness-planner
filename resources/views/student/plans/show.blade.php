{{-- <!-- 🏁 Start Workout & Diet Section -->
<div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-400 mt-8">
    <h3 class="text-2xl font-bold text-yellow-700 mb-4">🚀 Start Your Plan</h3>

    @if(!$progress->completed)
        <p class="mb-4">
            You are currently on <strong>Day {{ $progress->current_day }}</strong> of {{ $plan->duration_days }} days.
            <br>
            {{ $plan->duration_days - $progress->current_day }} days left to reach your goal!
        </p>

        <div class="bg-gray-50 p-4 rounded-lg mb-4">
            <h4 class="font-semibold text-lg mb-2">Workout for Day {{ $progress->current_day }}</h4>
            @php
                $dayWorkout = $plan->days->where('day_number', $progress->current_day)->first();
            @endphp
            @if($dayWorkout)
                <p class="text-gray-800">{{ $dayWorkout->title }}</p>
                <p class="text-sm text-gray-500">{{ $dayWorkout->description }}</p>
            @endif
        </div>

        <div class="bg-green-50 p-4 rounded-lg mb-4">
            <h4 class="font-semibold text-lg mb-2">Diet for Day {{ $progress->current_day }}</h4>
            @foreach($diet[$progress->current_day] ?? [] as $meal)
                <p class="text-gray-800"><span class="font-medium">{{ $meal->meal_time }}:</span> {{ $meal->meal }}</p>
            @endforeach
        </div>

        <form action="{{ route('student.plan.mark_done', $plan->id) }}" method="POST">
            @csrf
            <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-5 py-2 rounded-lg font-medium shadow transition">
                ✅ Mark Day {{ $progress->current_day }} as Done
            </button>
        </form>

        <!-- Motivation Message -->
        <p class="mt-4 text-purple-700 font-semibold">
            Keep going! Every day counts towards your goal 💪
        </p>
    @else
        <p class="text-green-700 font-bold text-lg">🎉 Congratulations! You have completed this plan.</p>
    @endif
</div> --}}
