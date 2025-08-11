<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Diet Plans for: {{ $category->goal }} - {{ $category->target_area }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($plans as $plan)
                <a href="{{ route('diet.show', $plan->id) }}" class="block p-4 border rounded bg-purple-800 hover:bg-purple-900 transition">
                    <h2 class="text-lg font-semibold mb-1">Day {{ $plan->day_number }}</h2>
                    <p class="capitalize font-medium">{{ $plan->meal_time }}: {{ \Illuminate\Support\Str::limit($plan->meal, 60) }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            <a href="{{ route('diet.categories') }}" class="text-purple-300 hover:underline">&larr; Back to categories</a>
        </div>
    </div>
</x-app-layout>
