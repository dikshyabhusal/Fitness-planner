<x-app-layout>
    <div class="max-w-5xl mx-auto py-10">
        <h2 class="text-3xl font-bold text-purple-700 mb-6">My Students</h2>

        @if($students->count())
            <div class="bg-white rounded-lg shadow p-6">
                <ul class="space-y-4">
                    @foreach($students as $student)
                        <li class="border-b pb-2">
                            <span class="font-semibold">{{ $student->name }}</span> 
                            <span class="text-sm text-gray-600">({{ $student->email }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-300">No students found.</p>
        @endif
    </div>
</x-app-layout>
