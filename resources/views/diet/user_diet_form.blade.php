<x-app-layout>
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Create New Diet Plan</h2>

    @if(session('success'))
        <div class="text-green-600 font-medium mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Step 1: Create or select goal and target area --}}
    @if(!session('category_id'))
        <form method="POST" action="{{ route('diet.user.createCategory') }}">
            @csrf

            <div class="mb-4">
                <label for="goal" class="block font-semibold mb-1">Goal</label>
                <input type="text" name="goal" id="goal" required class="w-full border p-2 rounded" placeholder="e.g. Lose Weight">
            </div>

            <div class="mb-4">
                <label for="target_area" class="block font-semibold mb-1">Target Area</label>
                <input type="text" name="target_area" id="target_area" required class="w-full border p-2 rounded" placeholder="e.g. Belly">
            </div>

            <button class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">➡️ Continue to Meal Plan</button>
        </form>
    @else

    {{-- Step 2: Meal Plan after category is created --}}
    <form method="POST" action="{{ route('diet.user.store') }}">
        @csrf
        <input type="hidden" name="diet_category_id" value="{{ session('category_id') }}">

        <h4 class="text-lg font-bold mb-2">7-Day Meal Plan</h4>

        @for($day = 1; $day <= 7; $day++)
            <div class="bg-gray-100 rounded p-4 mb-4">
                <h5 class="font-semibold mb-2">Day {{ $day }}</h5>

                @foreach(['breakfast', 'lunch', 'dinner'] as $meal_time)
                    <div class="mb-2">
                        <label class="block text-sm">{{ ucfirst($meal_time) }}</label>
                        <input type="text" name="days[{{ $day }}][{{ $meal_time }}]" class="w-full border p-2 rounded" placeholder="Enter meal for {{ $meal_time }}">
                    </div>
                @endforeach
            </div>
        @endfor

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Save Meal Plan</button>
    </form>
    @endif
</div>
</x-app-layout>
