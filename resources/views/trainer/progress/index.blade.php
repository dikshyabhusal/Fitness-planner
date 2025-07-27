<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-3xl font-bold text-purple-900 mb-6">Your Students' Progress</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($students as $student)
                <div class="bg-white rounded-lg p-6 shadow">
                    <h2 class="text-xl font-semibold">{{ $student->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $student->email }}</p>
                    <a href="{{ route('trainer.progress.student', $student->id) }}" class="text-purple-600 font-semibold mt-4 inline-block">View Progress →</a>
                </div>
            @empty
                <p class="text-gray-600">No students assigned yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
