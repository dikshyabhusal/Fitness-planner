<x-app-layout>
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Create New Diet Plan</h2>

    @if(session('success'))
        <div class="text-green-600 font-medium mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="text-red-600 font-medium mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('diet.user.store') }}">
        @csrf

        <!-- Add or Select Goal -->
        <div class="mb-4">
            <label for="new_goal" class="block font-semibold mb-1">Add New Goal</label>
            <input type="text" name="new_goal" id="new_goal" class="w-full p-2 border rounded" placeholder="e.g. Lose Weight">
        </div>

        <div class="mb-4">
            <label for="goal" class="block font-semibold mb-1">Or Select Existing Goal</label>
            <select id="goal" name="goal" class="w-full p-2 border rounded">
                <option value="">-- Select Goal --</option>
                @php $goals = collect($categories)->pluck('goal')->unique(); @endphp
                @foreach($goals as $goal)
                    <option value="{{ $goal }}">{{ $goal }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add or Select Target Area -->
        <div class="mb-4">
            <label for="new_target" class="block font-semibold mb-1">Add New Target Area</label>
            <input type="text" name="new_target" id="new_target" class="w-full p-2 border rounded" placeholder="e.g. Belly, Chest">
        </div>

        <div class="mb-4">
            <label for="diet_category_id" class="block font-semibold mb-1">Or Select Existing Target Area</label>
            <select name="diet_category_id" id="diet_category_id" class="w-full p-2 border rounded">
                <option value="">-- Select Target Area --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-goal="{{ $category->goal }}">
                        {{ $category->target_area }} ({{ $category->goal }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Meal Plan Section -->
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

        <button class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">💾 Save Plan</button>
    </form>
</div>

<script>
    document.getElementById('goal')?.addEventListener('change', function () {
        const selectedGoal = this.value;
        const targetAreaDropdown = document.getElementById('diet_category_id');
        const options = targetAreaDropdown.querySelectorAll('option');

        options.forEach(option => {
            const goal = option.getAttribute('data-goal');
            option.style.display = (goal === selectedGoal || option.value === '') ? 'block' : 'none';
        });

        targetAreaDropdown.value = '';
    });
</script>
</x-app-layout>
