<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-700">🎥 Uploaded Exercise Videos</h1>
            <a href="{{ route('videos.create') }}"
               class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
               ➕ Add New Video
            </a>
        </div>

        <table class="w-full border-collapse border border-gray-300 text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2">ID</th>
                    <th class="border border-gray-300 px-3 py-2">Title</th>
                    <th class="border border-gray-300 px-3 py-2">Body Part</th>
                    <th class="border border-gray-300 px-3 py-2">Goal</th>
                    <th class="border border-gray-300 px-3 py-2">Duration</th>
                    <th class="border border-gray-300 px-3 py-2">Video</th>
                    <th class="border border-gray-300 px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $video)
                    <tr>
                        <td class="border border-gray-300 px-3 py-2">{{ $video->id }}</td>
                        <td class="border border-gray-300 px-3 py-2 font-semibold">{{ $video->title }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $video->body_part }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $video->goal }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $video->duration }} sec</td>
                        <td class="border border-gray-300 px-3 py-2">
                            
                            <video width="200" controls class="rounded-lg">
                                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                       
                        <td class="border border-gray-300 px-3 py-2 space-x-2">
                            <a href="{{ route('videos.edit', $video->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">Edit</a>
                            
                            <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete this video?')" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No videos uploaded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
