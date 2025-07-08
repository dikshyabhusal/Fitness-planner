<x-app-layout>
<div class="max-w-4xl mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            🍴 Diet Plan: {{ $category->goal }} - {{ $category->target_area }}
        </h2>
        <!-- Back Button -->

        <!-- 🔖 Bookmark Form -->
        <form method="POST" action="{{ route('diet.bookmark', $category->id) }}">
            @csrf
            @php
                $bookmarked = \App\Models\DietBookmark::where('user_id', auth()->id())
                    ->where('diet_category_id', $category->id)
                    ->exists();
            @endphp
            <button type="submit" class="text-xl px-4 py-1 rounded 
                {{ $bookmarked ? 'text-red-500' : 'text-gray-500' }} 
                hover:text-red-600 transition">
                {{ $bookmarked ? '❤️ Bookmarked' : '🤍 Add to Bookmark' }}
            </button>
        </form>
    </div>

    @foreach($meals as $day => $plans)
        <div class="bg-gray-100 p-4 rounded mb-4">
            <h3 class="font-bold text-purple-600 mb-2">Day {{ $day }}</h3>
            @foreach($plans as $plan)
                <p><strong>{{ ucfirst($plan->meal_time) }}:</strong> {{ $plan->meal }}</p>
            @endforeach
        </div>
    @endforeach
</div>
</x-app-layout>
