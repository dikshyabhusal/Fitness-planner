<x-app-layout>
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">📋 Recommend Me a Diet Plan</h2>
    <form method="POST" action="{{ route('diet.recommend') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Goal</label>
            <select name="goal" class="w-full border rounded p-2" required>
                <option value="">Select Goal</option>
                @foreach($goals as $goal)
                    <option value="{{ $goal }}">{{ $goal }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Target Area</label>
            <input type="text" name="target_area" class="w-full border rounded p-2" placeholder="e.g. Belly, Chest" required>
        </div>

        <button class="bg-purple-600 text-white px-4 py-2 rounded">🔍 Get Recommendation</button>
    </form>
</div>
</x-app-layout>
