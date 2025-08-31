<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-8 relative">

        {{-- Action Buttons --}}
        

        <h2 class="text-3xl font-serif mb-6">{{ $exercise->title }}</h2>

        {{-- Media --}}
        @if($exercise->photo)
            <div class="mb-6">
                <img src="{{ asset('storage/'.$exercise->photo) }}" 
                     alt="{{ $exercise->title }}" 
                     class="rounded-lg shadow-md w-full max-h-96 object-cover">
            </div>
        @endif

        @if($exercise->video)
            <div class="mb-6">
                <video controls class="rounded-lg shadow-md w-full max-h-96">
                    <source src="{{ asset('storage/'.$exercise->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        <div class="space-y-6">
            @if($exercise->coach_tips)
                <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded-lg shadow-sm">
                    <h2 class="font-semibold text-purple-700 mb-2 flex items-center">
                        <span class="mr-2 text-xl">💡</span> Coach Tips
                    </h2>
                    <p class="text-gray-800">{{ $exercise->coach_tips }}</p>
                </div>
            @endif

            @if($exercise->precautions)
                <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg shadow-sm">
                    <h2 class="font-semibold text-red-700 mb-2 flex items-center">
                        <span class="mr-2 text-xl">⚠️</span> Precautions
                    </h2>
                    <p class="text-gray-800">{{ $exercise->precautions }}</p>
                </div>
            @endif

            @if($exercise->how_to_start)
                <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded-lg shadow-sm">
                    <h2 class="font-semibold text-purple-700 mb-2 flex items-center">
                        <span class="mr-2 text-xl">▶️</span> How to Start
                    </h2>
                    <p class="text-gray-800">{{ $exercise->how_to_start }}</p>
                </div>
            @endif
            <div class="absolute top-0 right-0 flex space-x-2">
            <a href="{{ route('exercises.edit', $exercise->id) }}" 
               class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                Edit
            </a>

            <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this exercise?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete
                </button>
            </form>
        </div>
        </div>
        
    </div>
</x-app-layout>
