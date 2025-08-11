<x-app-layout>
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-purple-600 mb-6">My Workouts</h1>
    <table class="w-full border border-purple-200 rounded-lg">
        <thead class="bg-purple-50">
            <tr>
                <th class="p-3 text-left">Workout Name</th>
                <th class="p-3 text-left">Created On</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workouts as $workout)
                <tr class="border-b border-purple-100">
                    <td class="p-3">{{ $workout->title }}</td>
                    <td class="p-3">{{ $workout->created_at->format('Y-m-d') }}</td>
                    <td class="p-3 text-center">
                        <a href="{{ route('trainer.workouts.progress', $workout->id) }}" 
                           class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600">
                            View Progress
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-3 text-center text-gray-500">No workouts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-app-layout>
