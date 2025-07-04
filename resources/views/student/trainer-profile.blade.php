<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <div class="mb-6 border-b pb-4">
            <h1 class="text-3xl font-bold text-purple-700">{{ $trainer->name }}</h1>
            <p class="text-gray-600 mt-2">Trainer Profile</p>
        </div>

        <h2 class="text-xl font-semibold mb-4 text-purple-600">Workout Plans by {{ $trainer->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($workouts as $plan)
                <div class="p-4 border rounded shadow-sm bg-gradient-to-r from-purple-50 to-purple-100">
                    <h3 class="font-bold text-gray-800">{{ $plan->title }}</h3>
                    <a href="{{ route('workout.show', $plan->id) }}"
                       class="text-sm text-purple-600 hover:underline">View Plan</a>
                </div>
            @empty
                <p class="text-gray-500">No workout plans found.</p>
            @endforelse
        </div>

        <hr class="my-8">

        <h2 class="text-xl font-semibold mb-4 text-purple-600">💬 Contact Trainer</h2>
        <livewire:chat-box :trainer="$trainer" />
    </div>
    <script>
    Livewire.on('openChatWith', senderId => {
        window.location.href = `/trainer/chat/${senderId}`; // you create this route
    });
</script>

</x-app-layout>
