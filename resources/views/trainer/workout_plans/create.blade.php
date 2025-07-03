<x-app-layout>


<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Create Workout Plan</h2>
    <form action="{{ route('trainer.workout_plans.store') }}" method="POST">
        @csrf

        <!-- Plan Info -->
        <div class="mb-4">
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Gender</label>
            <select name="gender" class="w-full border rounded p-2">
                <option value="both">Both</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block font-semibold">Duration (days)</label>
            <input type="number" name="duration_days" min="1" class="w-full border rounded p-2" required>
        </div>

        <hr class="my-6">

        <!-- Exercise Days (1–7) -->
        <h3 class="text-lg font-semibold mb-2">Enter Exercise for Day 1–7</h3>
        @for($i = 1; $i <= 7; $i++)
            <div class="mb-4">
                <label class="block font-semibold">Day {{ $i }} Title</label>
                <input type="text" name="workout_days[{{ $i }}][title]" class="w-full border rounded p-2" placeholder="e.g., Full Body or Rest" required>

                <label class="block mt-2">Description (optional)</label>
                <textarea name="workout_days[{{ $i }}][description]" class="w-full border rounded p-2"></textarea>
            </div>
        @endfor

        <hr class="my-6">

        <!-- Diet Plan (1–7 days × 3 meals) -->
        <h3 class="text-lg font-semibold mb-2">Diet Plan for Each Day</h3>
        @for($i = 1; $i <= 7; $i++)
            <div class="mb-4 border p-4 rounded bg-gray-100">
                <h4 class="font-bold mb-2">Day {{ $i }} Diet</h4>
                <label>Breakfast</label>
                <input type="text" name="diet[{{ $i }}][breakfast]" class="w-full border rounded p-2 mb-2">

                <label>Lunch</label>
                <input type="text" name="diet[{{ $i }}][lunch]" class="w-full border rounded p-2 mb-2">

                <label>Dinner</label>
                <input type="text" name="diet[{{ $i }}][dinner]" class="w-full border rounded p-2">
            </div>
        @endfor

        <button class="bg-purple-600 text-white px-4 py-2 rounded">Create Plan</button>
    </form>
</div>
</x-app-layout>
