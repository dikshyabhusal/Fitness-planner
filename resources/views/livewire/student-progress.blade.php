<div class="p-4 bg-white rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-bold mb-4">Today's Progress - {{ \Carbon\Carbon::parse($today)->format('F j, Y') }}</h2>

    <div class="space-y-3">
        <label class="flex items-center space-x-2">
            <input type="checkbox" wire:model="workout_done">
            <span>💪 Workout Done</span>
        </label>

        <label class="flex items-center space-x-2">
            <input type="checkbox" wire:model="diet_done">
            <span>🥗 Diet Followed</span>
        </label>
    </div>

    <button wire:click="saveProgress"
        class="mt-4 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
        💾 Save Progress
    </button>

    @if (session()->has('message'))
        <p class="text-green-600 mt-2">{{ session('message') }}</p>
    @endif
</div>
