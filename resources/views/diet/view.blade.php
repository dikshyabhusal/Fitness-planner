<x-app-layout>
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">My Diet Plans</h2>

        @if($diets->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">No diet plans created yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Meal Time</th>
                            <th class="py-3 px-4 text-left">Meal</th>
                            <th class="py-3 px-4 text-left">Gopal</th>
                            {{-- <th class="py-3 px-4 text-left">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diets as $diet)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="py-2 px-4">{{ $diet->meal_time }}</td>
                            <td class="py-2 px-4">{{ $diet->meal }}</td>
                            <td class="py-2 px-4">{{ $diet->category->goal }}</td>
                            {{-- <td class="py-2 px-4 space-x-2"> --}}
                                {{-- <a href="{{ route('diets.show', $diet->id) }}" class="text-blue-500 hover:underline">View</a> --}}
                                {{-- <a href="{{ route('diets.edit', $diet->id) }}" class="text-green-500 hover:underline">Edit</a> --}}
                            {{-- </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
