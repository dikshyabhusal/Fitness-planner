<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-3xl font-bold mb-6 text-purple-900">{{ $student->name }}'s Progress Report</h2>

        <table class="w-full bg-white rounded shadow text-left">
            <thead>
                <tr class="bg-purple-200">
                    <th class="p-3">Date</th>
                    <th class="p-3">Workout</th>
                    <th class="p-3">Diet</th>
                </tr>
            </thead>
            <tbody>
                @foreach($progress as $entry)
                    <tr class="border-b">
                        <td class="p-3">{{ \Carbon\Carbon::parse($entry->date)->format('M d, Y') }}</td>
                        <td class="p-3">{{ $entry->workout_done ? '✅' : '❌' }}</td>
                        <td class="p-3">{{ $entry->diet_done ? '✅' : '❌' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
