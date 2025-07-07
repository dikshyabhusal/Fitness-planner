<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-6">Choose Diet Goal</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($categories as $cat)
                <a href="{{ route('diet.category.show', $cat->id) }}" class="bg-white rounded shadow p-4 hover:bg-purple-50">
                    <h3 class="text-xl font-bold">{{ $cat->goal }}</h3>
                    <p class="text-gray-600">Focus: {{ $cat->target_area }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
