<x-app-layout>
<div class="max-w-5xl mx-auto mt-10 space-y-8">

    <!-- Header -->
    <div class="text-center">
        <h2 class="text-3xl font-extrabold text-purple-700 mb-2">✨ Create Your Workout Plan ✨</h2>
        <p class="text-gray-500">Design workout + diet schedule for your students with style and detail</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('trainer.workout_plans.store') }}" enctype="multipart/form-data" 
          class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
        @csrf

        <!-- Plan Info -->
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Workout Cover Image</label>
                <input type="file" name="image" 
                       class="w-full border rounded-xl p-3 bg-gray-50 focus:ring-2 focus:ring-purple-500">
            </div> 

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="title" required
                       class="w-full border rounded-xl p-3 bg-gray-50 focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <div class="mt-6">
            <label class="block font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border rounded-xl p-3 bg-gray-50 focus:ring-2 focus:ring-purple-500"></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Gender</label>
                <select name="gender" class="w-full border rounded-xl p-3 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                    <option value="both">Both</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="difficulty_level" class="block text-gray-700 font-bold mb-2">Difficulty Level</label>
                <select name="difficulty_level" id="difficulty_level" class="border rounded w-full p-2">
                    <option value="0" {{ old('difficulty_level')==0 ? 'selected' : '' }}>Easy</option>
                    <option value="1" {{ old('difficulty_level')==1 ? 'selected' : '' }}>Medium</option>
                    <option value="2" {{ old('difficulty_level')==2 ? 'selected' : '' }}>Hard</option>
                </select>
            </div>


            <div>
                <label class="block font-semibold text-gray-700 mb-1">Duration (days)</label>
                <input type="number" name="duration_days" min="1" required
                       class="w-full border rounded-xl p-3 bg-gray-50 focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- Workout Days -->
        <div class="mt-10">
            <h3 class="text-xl font-bold text-purple-700 mb-4">🏋️ Exercises (Day 1 – 7)</h3>
            <div class="grid md:grid-cols-2 gap-6">
                @for($i = 1; $i <= 7; $i++)
                    <div class="p-5 border rounded-xl bg-gradient-to-br from-purple-50 to-white shadow-sm hover:shadow-md transition">
                        <label class="block font-semibold text-gray-800">Day {{ $i }} Title</label>
                        <input type="text" name="workout_days[{{ $i }}][title]" required
                               placeholder="e.g., Full Body or Rest"
                               class="w-full mt-1 border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">

                        <label class="block mt-3 text-gray-700">Description (optional)</label>
                        <textarea name="workout_days[{{ $i }}][description]"
                                  class="w-full border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500"></textarea>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Diet Plan -->
        <div class="mt-10">
            <h3 class="text-xl font-bold text-purple-700 mb-4">🥗 Diet Plan (Day 1 – 7)</h3>
            <div class="space-y-6">
                @for($i = 1; $i <= 7; $i++)
                    <div class="p-5 border rounded-xl bg-gradient-to-r from-white to-purple-50 shadow-sm hover:shadow-md transition">
                        <h4 class="font-bold text-gray-800 mb-3">Day {{ $i }} Diet</h4>

                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600">Breakfast</label>
                                <input type="text" name="diet[{{ $i }}][breakfast]"
                                       class="w-full border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Lunch</label>
                                <input type="text" name="diet[{{ $i }}][lunch]"
                                       class="w-full border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Snacks</label>
                                <input type="text" name="diet[{{ $i }}][snacks]"
                                       class="w-full border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Dinner</label>
                                <input type="text" name="diet[{{ $i }}][dinner]"
                                       class="w-full border rounded-xl p-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-10 text-center">
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow-md transition">
                🚀 Create Plan
            </button>
        </div>
    </form>
</div>
</x-app-layout>
