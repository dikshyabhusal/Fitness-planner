<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h2 class="text-xl font-bold mb-4">Step 1: Select Goal and Target Area</h2>
        @if(session('success'))
            <div class="text-green-600">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('diet.step1.store') }}" enctype="multipart/form-data">

            @csrf
            <div class="mb-4">
                <label class="block font-medium">Upload Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Goal</label>
                <select name="goal" class="w-full p-2 border rounded" required>
                    <option value="">-- Select --</option>
                    <option value="Lose Weight">Lose Weight</option>
                    <option value="Gain Weight">Gain Weight</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Diet Type</label>
                <select name="target_area" class="w-full p-2 border rounded" required>
                    <option value="">-- Select --</option>
                    <option value="Kito Diet plan">Kito Diet plan</option>
                    <option value="Intermediate Fasting">Intermediate Fasting</option>
                    <option value="Balanced Diet">Balanced Diet</option>
                    <option value="Low-carb">Low-carb</option>
                    <option value="Low-fat">Low-fat</option>
                    <option value="Mediterranean diet">Mediterranean diet</option>
                    <option value="High-fat">High-fat</option>
                    <option value="High-carb">High-carb</option>
                    <option value="Complex-carb">Complex-carb</option>
                </select>
            </div>
            <button class="bg-purple-700 text-white px-4 py-2 rounded">Next ➡️</button>
        </form>
    </div>
</x-app-layout>
