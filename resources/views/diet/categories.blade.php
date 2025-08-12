<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold text-purple-600 mb-6">🍽️ Diet Categories</h1>

        {{-- Filters --}}
        <form method="GET" class="flex flex-wrap gap-4 mb-6 bg-purple-50 p-4 rounded-lg shadow">
            {{-- Search --}}
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Search by goal or target area" 
                class="border border-purple-200 p-2 rounded w-full sm:w-1/3">

            {{-- Target Area --}}
            <select name="target_area" class="border border-purple-200 p-2 rounded w-full sm:w-1/4">
                <option value="">All Target Areas</option>
                @foreach($targetAreas as $area)
                    <option value="{{ $area }}" {{ request('target_area') == $area ? 'selected' : '' }}>
                        {{ ucfirst($area) }}
                    </option>
                @endforeach
            </select>

            {{-- Goal --}}
            <select name="goal" class="border border-purple-200 p-2 rounded w-full sm:w-1/4">
                <option value="">All Goals</option>
                @foreach($goals as $goal)
                    <option value="{{ $goal }}" {{ request('goal') == $goal ? 'selected' : '' }}>
                        {{ ucfirst($goal) }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Filter
            </button>
        </form>

        {{-- Categories --}}
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="bg-white border border-purple-200 rounded-lg shadow p-4 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-purple-700">{{ ucfirst($category->target_area) }}</h2>
                        <p class="text-gray-500">{{ ucfirst($category->goal) }}</p>

                        <div class="mt-4">
                            <a href="{{ route('diet.category.plans', $category->id) }}" 
                                class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                                View Plans
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded">
                🚫 No diet categories found matching your search/filter.
            </div>
        @endif

    </div>
</x-app-layout>
