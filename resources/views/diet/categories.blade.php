<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Diet Categories</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('diet.category.plans', $category) }}" class="block p-6 bg-purple-700 rounded-lg hover:bg-purple-800 transition">
                    <h2 class="text-xl font-semibold text-white mb-2">{{ $category->goal }} - {{ $category->target_area }}</h2>
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->goal }}" class="w-full h-36 object-cover rounded" />
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
