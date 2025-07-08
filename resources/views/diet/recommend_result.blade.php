<x-app-layout>
<div class="max-w-6xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">🥗 Recommended Diet Plans</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        @forelse($categories as $category)
            <div class="relative bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">

                <!-- Image -->
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Diet Image" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif

                <!-- Bookmark Red Heart Only If Bookmarked -->
                @php
                    $isBookmarked = \App\Models\DietBookmark::where('user_id', auth()->id())
                        ->where('diet_category_id', $category->id)
                        ->exists();
                @endphp

                @if($isBookmarked)
                    <div class="absolute top-2 right-2 text-red-600 text-xl">
                        ❤️
                    </div>
                @endif

                <!-- Info -->
                <div class="p-4">
                    <h3 class="text-lg font-bold text-purple-700">{{ $category->goal }}</h3>
                    <p class="text-sm text-gray-600 mb-3">Target: {{ $category->target_area }}</p>
                    
                    <a href="{{ route('diet.recommend.show', $category->id) }}" class="inline-block text-purple-600 font-medium hover:underline">
                        📄 View Full Plan →
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No matching plans found.</p>
        @endforelse
    </div>
</div>
</x-app-layout>
