<x-app-layout>
    <div class="max-w-7xl mx-auto mt-12 px-4">
        <h2 class="text-4xl font-extrabold text-purple-700 mb-10 text-center">🏋️ Explore Workout Plans</h2>

        <!-- 🔍 Search and Filter -->
        <form method="GET" action="{{ route('student.workout_plans.index') }}" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="search" placeholder="Search by title..." value="{{ request('search') }}"
                   class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm px-4 py-2" />

            <select name="gender" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm px-4 py-2">
                <option value="">Filter by Gender</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>

            <button type="submit" class="bg-purple-600 text-white rounded-lg px-4 py-2 hover:bg-purple-700 transition w-full">
                🔎 Search
            </button>
        </form>

        <!-- 🧱 Workout Plan Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($plans as $plan)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 border border-purple-100 p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-purple-800 mb-1">{{ $plan->title }}</h3>
                        <p class="text-gray-600 text-sm mb-1">👤 Trainer: <span class="font-semibold">{{ $plan->trainer->name }}</span></p>
                        <p class="text-gray-600 text-sm mb-1">⏳ Duration: {{ $plan->duration_days }} days</p>
                        <p class="text-gray-600 text-sm mb-3">🎯 For: <span class="capitalize">{{ $plan->gender }}</span></p>
                    </div>

                    <a href="{{ route('student.workout_plans.show', $plan->id) }}"
                       class="mt-4 inline-block bg-purple-600 text-white text-center px-1 py-1 rounded-lg font-medium hover:bg-purple-700 transition">
                        🔍 View Plan
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    No workout plans found.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
