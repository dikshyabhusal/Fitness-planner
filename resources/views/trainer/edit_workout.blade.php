<x-app-layout>
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Workout</h1>

    <form method="POST" action="{{ route('trainer.workouts.update', $workout->id) }}">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Workout Title</label>
            <input type="text" name="title" value="{{ old('title', $workout->title) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <button type="submit" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update Workout
        </button>
    </form>
</div>
</x-app-layout>
