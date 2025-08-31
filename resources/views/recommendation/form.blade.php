<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Workout Recommendation</h1>

        <form action="{{ route('recommendation.recommend') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Your Goal:</label>
                <select name="goal" class="border p-2 w-full" required>
                    <option value="Lose Weight">Lose Weight</option>
                    <option value="Gain Muscle">Gain Muscle</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Focus Area:</label>
                <select name="area" class="border p-2 w-full" required>
                    <option value="Abs">Abs</option>
                    <option value="Chest">Chest</option>
                    <option value="Leg">Leg</option>
                    <option value="Full Body">Full Body</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Get Recommendations
            </button>
        </form>
    </div>
</x-app-layout>
