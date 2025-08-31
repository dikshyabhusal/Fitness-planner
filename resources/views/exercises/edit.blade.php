<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-8">

        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Edit Exercise</h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-600 p-4 rounded">
                <ul class="list-disc list-inside text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('exercises.update', $exercise->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $exercise->title) }}" 
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">
            </div>

            {{-- Photo --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="photo">Photo (optional)</label>
                @if($exercise->photo)
                    <img src="{{ asset('storage/'.$exercise->photo) }}" class="mb-2 rounded w-48 h-48 object-cover">
                @endif
                <input type="file" name="photo" id="photo" accept="image/*" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            {{-- Video --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="video">Video (optional)</label>
                @if($exercise->video)
                    <video controls class="mb-2 rounded w-full max-h-64">
                        <source src="{{ asset('storage/'.$exercise->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
                <input type="file" name="video" id="video" accept="video/mp4,video/mov,video/avi" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            {{-- Coach Tips --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="coach_tips">Coach Tips</label>
                <textarea name="coach_tips" id="coach_tips" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">{{ old('coach_tips', $exercise->coach_tips) }}</textarea>
            </div>

            {{-- Precautions --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="precautions">Precautions</label>
                <textarea name="precautions" id="precautions" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">{{ old('precautions', $exercise->precautions) }}</textarea>
            </div>

            {{-- How to Start --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="how_to_start">How to Start</label>
                <textarea name="how_to_start" id="how_to_start" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">{{ old('how_to_start', $exercise->how_to_start) }}</textarea>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('exercises.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Update Exercise</button>
            </div>

        </form>
    </div>
</x-app-layout>
