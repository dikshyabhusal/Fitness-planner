<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Detailed Diet Plan - Day {{ $dietPlan->day_number }}</h1>
        <h2 class="text-xl mb-4">{{ $dietPlan->category->goal }} - {{ $dietPlan->category->target_area }}</h2>

        <div class="space-y-4">
            @foreach ($detailedMeals as $meal)
                <div class="p-4 border rounded bg-purple-900">
                    <h3 class="text-lg font-semibold capitalize">{{ $meal->meal_time }}</h3>
                    <p>{{ $meal->meal }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="{{ route('diet.category.plans', $dietPlan->category) }}" class="text-purple-300 hover:underline">&larr; Back to diet plans</a>
        </div>
    </div>
</x-app-layout>
