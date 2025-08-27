<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">
            @isset($category)
                {{ $category->name }} Exercises
            @else
                All Exercises
            @endisset
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($exercises as $exercise)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transform transition duration-300">
                    
                    <!-- Video / Image Preview -->
                    @if($exercise->video)
                        <div class="w-full h-48 overflow-hidden">
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ asset('storage/'.$exercise->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @elseif($exercise->image)
                        <img src="{{ asset('storage/'.$exercise->image) }}" alt="{{ $exercise->title }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <!-- Exercise Name -->
                        <h2 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $exercise->title }}</h2>

                        

                        <!-- View Details Button -->
                        <a href="{{ route('exercises.show', $exercise->id) }}" 
                           class="block text-center bg-purple-600 text-white py-2 rounded hover:bg-purple-700 font-semibold transition-colors duration-200">
                           View Details →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $exercises->links() }}
        </div>
    </div>
</x-app-layout>
