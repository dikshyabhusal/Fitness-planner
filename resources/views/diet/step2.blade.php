<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-xl font-bold mb-4">Step 2: 7-Day Meal Plan for {{ $category->goal }} ({{ $category->target_area }})</h2>

        <form method="POST" action="{{ route('diet.step2.store', $category->id) }}">
            @csrf

            @for($day = 1; $day <= 7; $day++)
                <div class="bg-gray-100 rounded p-4 mb-4">
                    <h4 class="font-semibold mb-2">Day {{ $day }}</h4>

                    @foreach(['breakfast', 'lunch','snacks', 'dinner'] as $meal_time)
                        <div class="mb-2">
                            <label class="block text-sm">{{ ucfirst($meal_time) }}</label>
                            <input type="text" name="days[{{ $day }}][{{ $meal_time }}]" class="w-full border p-2 rounded" placeholder="Enter {{ $meal_time }}">
                        </div>
                    @endforeach
                </div>
            @endfor

            <button class="bg-purple-700 text-white px-4 py-2 rounded">💾 Save Plan</button>
        </form>
    </div>
</x-app-layout>
