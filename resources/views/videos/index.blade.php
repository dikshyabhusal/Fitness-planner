<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-4">Exercise Video Library</h2>

        <form method="GET" class="mb-6 flex gap-4">
            <input type="text" name="body_part" placeholder="Body Part" class="border p-2 rounded">
            <input type="text" name="goal" placeholder="Goal" class="border p-2 rounded">
            <input type="number" name="duration" placeholder="Max Duration" class="border p-2 rounded">
            <button class="bg-purple-600 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($videos as $video)
            <div class="bg-white rounded shadow p-4">
                <h3 class="font-bold text-lg">{{ $video->title }}</h3>
                <video controls class="w-full h-48 mt-2">
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p class="text-sm mt-2 text-gray-600">Body Part: {{ $video->body_part }}</p>
                <p class="text-sm text-gray-600">Goal: {{ $video->goal }}</p>
                <p class="text-sm text-gray-600">Duration: {{ $video->duration }} min</p>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $videos->links() }}
        </div>
    </div>
</x-app-layout>
