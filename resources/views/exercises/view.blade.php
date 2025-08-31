<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-semibold mb-6">My Exercises</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exercises as $exercise)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $exercise->title }}</td>
                            <td class="px-4 py-2">{{ $exercise->category->name ?? 'N/A' }}</td>

                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('exercises.show', $exercise->id) }}" class="text-blue-500 hover:underline">View</a>
                                {{-- <a href="{{ route('exercises.edit', $exercise->id) }}" class="text-green-500 hover:underline">Edit</a> --}}
                                <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No exercises found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
