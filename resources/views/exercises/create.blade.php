<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold mb-6">Upload New Exercise</h2>

        <form method="POST" action="{{ route('exercises.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Exercise Title</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="exercise_category_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('exercise_category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Coach Tips -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Coach Tips</label>
                <textarea name="coach_tips" rows="3" 
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('coach_tips') }}</textarea>
            </div>

            <!-- Precautions -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Precautions</label>
                <textarea name="precautions" rows="3" 
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('precautions') }}</textarea>
            </div>

            <!-- How to Start -->
            <div>
                <label class="block text-sm font-medium text-gray-700">How to Start</label>
                <textarea name="how_to_start" rows="3" 
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('how_to_start') }}</textarea>
            </div>

            <!-- Photo Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" class="mt-1 block w-full">
            </div>

            <!-- Video Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Video</label>
                <input type="file" name="video" class="mt-1 block w-full">
            </div>

            <!-- Submit -->
            <div>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    Save Exercise
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
