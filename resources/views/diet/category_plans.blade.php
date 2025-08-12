<x-app-layout>
<div class="max-w-4xl mx-auto py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-purple-700 flex items-center gap-2">
                🍴 Diet Plan:
                <span class="text-gray-800">{{ $category->goal }} - {{ ucfirst($category->target_area) }}</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Personalized daily meal schedule</p>
        </div>

        <!-- 🔖 Bookmark -->
        <form method="POST" action="{{ route('diet.bookmark', $category->id) }}">
            @csrf
            @php
                $bookmarked = \App\Models\DietBookmark::where('user_id', auth()->id())
                    ->where('diet_category_id', $category->id)
                    ->exists();
            @endphp
            <button type="submit" 
                class="mt-4 md:mt-0 px-4 py-2 text-lg font-semibold rounded-lg shadow 
                {{ $bookmarked ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }}
                hover:shadow-md transition">
                {{ $bookmarked ? '❤️ Bookmarked' : '🤍 Add to Bookmark' }}
            </button>
        </form>
    </div>

    <!-- Meals -->
    @if($meals->count())
        @foreach($meals as $day => $plans)
            <div class="bg-white p-5 rounded-xl shadow mb-6 border border-gray-100">
                <h3 class="text-xl font-bold text-purple-600 mb-4">Day {{ $day }}</h3>
                @if($plans->count())
                    <ul class="space-y-3">
                        @foreach($plans as $plan)
                            @php
                                $icon = match(strtolower($plan->meal_time)) {
                                    'breakfast' => '🍳',
                                    'lunch' => '🍛',
                                    'dinner' => '🥗',
                                    'snack' => '🍎',
                                    default => '🍽️'
                                };
                            @endphp
                            <li class="flex items-start gap-3">
                                <span class="text-2xl">{{ $icon }}</span>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ ucfirst($plan->meal_time) }}</p>
                                    <p class="text-gray-600">{{ $plan->meal }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic">No meals planned for this day.</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-gray-500 text-center">No diet plans found for this category.</p>
    @endif
</div>
</x-app-layout>
