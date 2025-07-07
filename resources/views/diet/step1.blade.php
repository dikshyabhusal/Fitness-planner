<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h2 class="text-xl font-bold mb-4">Step 1: Select Goal and Target Area</h2>

        @if(session('success'))
            <div class="text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('diet.step1.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Goal</label>
                <select name="goal" class="w-full p-2 border rounded" required>
                    <option value="">-- Select --</option>
                    <option value="Lose Weight">Lose Weight</option>
                    <option value="Gain Weight">Gain Weight</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Target Area</label>
                <select name="target_area" class="w-full p-2 border rounded" required>
                    <option value="">-- Select --</option>
                    <option value="Belly">Belly</option>
                    <option value="Chest">Chest</option>
                    <option value="Hip">Hip</option>
                </select>
            </div>

            <button class="bg-purple-700 text-white px-4 py-2 rounded">Next ➡️</button>
        </form>
    </div>
</x-app-layout>
