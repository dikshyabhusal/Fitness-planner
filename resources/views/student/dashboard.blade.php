<x-app-layout>
    <<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-extrabold text-purple-300 mb-8">Recommended Exercises for You</h1>

        @if($recommendedExercises->isEmpty())
            <p class="text-gray-300">No exercises available at the moment.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($recommendedExercises as $exercise)
                    <div class="bg-white/10 rounded-xl p-4 hover:bg-white/20 transition transform hover:-translate-y-1 shadow-lg backdrop-blur-md">
                        @if($exercise->photo)
                            <img src="{{ asset('storage/'.$exercise->photo) }}" 
                                 alt="{{ $exercise->title }}" 
                                 class="w-full h-44 object-cover rounded-lg mb-3">
                        @endif
                        <h3 class="text-xl font-bold text-purple-200 mb-2">{{ $exercise->title }}</h3>
                        <p class="text-gray-300 text-sm line-clamp-3">{{ $exercise->coach_tips ?? 'No tips available' }}</p>
                        <a href="{{ route('exercises.show', $exercise->id) }}" 
                           class="mt-3 inline-block bg-purple-600 px-4 py-2 rounded-full hover:bg-purple-700 transition font-semibold text-white">
                            View Details →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

</x-app-layout>
