
<x-app-layout>
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit Workout Plan</h2>

    <form action="{{ route('trainer.workout_plans.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Plan Info -->
        <div class="mb-4">
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" value="{{ $plan->title }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded p-2">{{ $plan->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Gender</label>
            <select name="gender" class="w-full border rounded p-2">
                <option value="both" @selected($plan->gender == 'both')>Both</option>
                <option value="male" @selected($plan->gender == 'male')>Male</option>
                <option value="female" @selected($plan->gender == 'female')>Female</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block font-semibold">Duration (days)</label>
            <input type="number" name="duration_days" value="{{ $plan->duration_days }}" min="1" class="w-full border rounded p-2" required>
        </div>

        <hr class="my-6">

        <!-- Exercise Days -->
        <h3 class="text-lg font-semibold mb-2">Edit Exercise for Day 1–7</h3>
        @for($i = 1; $i <= 7; $i++)
            @php
                $day = $plan->days->firstWhere('day_number', $i);
            @endphp
            <div class="mb-4">
                <label class="block font-semibold">Day {{ $i }} Title</label>
                <input type="text" name="workout_days[{{ $i }}][title]" value="{{ $day->title ?? '' }}" class="w-full border rounded p-2" required>

                <label class="block mt-2">Description</label>
                <textarea name="workout_days[{{ $i }}][description]" class="w-full border rounded p-2">{{ $day->description ?? '' }}</textarea>
            </div>
        @endfor

        <hr class="my-6">

        <!-- Diet Plan -->
        <h3 class="text-lg font-semibold mb-2">Edit Diet Plan (7-Day Base)</h3>
        @for($i = 1; $i <= 7; $i++)
            <div class="mb-4 border p-4 rounded bg-gray-100">
                <h4 class="font-bold mb-2">Day {{ $i }} Diet</h4>
                @php
                    $meals = $diet[$i] ?? collect([]);
                    $breakfast = $meals->firstWhere('meal_time', 'breakfast')->meal ?? '';
                    $lunch = $meals->firstWhere('meal_time', 'lunch')->meal ?? '';
                    $dinner = $meals->firstWhere('meal_time', 'dinner')->meal ?? '';
                @endphp

                <label>Breakfast</label>
                <input type="text" name="diet[{{ $i }}][breakfast]" value="{{ $breakfast }}" class="w-full border rounded p-2 mb-2">

                <label>Lunch</label>
                <input type="text" name="diet[{{ $i }}][lunch]" value="{{ $lunch }}" class="w-full border rounded p-2 mb-2">

                <label>Dinner</label>
                <input type="text" name="diet[{{ $i }}][dinner]" value="{{ $dinner }}" class="w-full border rounded p-2">
            </div>
        @endfor

        <button class="bg-purple-600 text-white px-4 py-2 rounded">Update Plan</button>
    </form>
</div>
</x-app-layout>
