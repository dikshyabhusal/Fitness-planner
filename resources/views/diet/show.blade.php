<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-4">{{ $category->goal }} - {{ $category->target_area }}</h2>
        <div class="grid grid-cols-1 gap-4">
            @foreach($category->dietPlans as $plan)
                <div class="p-4 border rounded bg-white">
                    <h3 class="text-xl font-semibold mb-2">Day {{ $plan->day_number }}</h3>
                    <p class="font-medium">{{ ucfirst($plan->meal_time) }}: {{ $plan->meal }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
