<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-xl p-6">
        <h2 class="text-2xl font-bold text-purple-700 mb-4">Edit Video</h2>

        <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ $video->title }}" class="w-full border rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full border rounded-md p-2">{{ $video->description }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Update</button>
                <a href="{{ route('videos.trainerindex') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
