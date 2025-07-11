<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h2 class="text-3xl font-bold mb-4 text-purple-700">🔥 Calories Burned Calculator</h2>
    <p class="text-gray-600 mb-6">
        Estimate the number of calories burned during your workout using your weight, activity duration, and MET (Metabolic Equivalent of Task).
    </p>

    <form method="POST" action="{{ route('calculator.caloriesBurned.calculate') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input type="number" name="weight" placeholder="Weight (kg)" required class="w-full border rounded px-3 py-2">
            <input type="number" name="duration" placeholder="Duration (minutes)" required class="w-full border rounded px-3 py-2">
            <input type="number" name="met" placeholder="MET value" required class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">
            Calculate
        </button>
    </form>

    @isset($burned)
        <div class="mt-6 p-4 bg-yellow-100 rounded text-yellow-800 font-semibold text-center">
            🔥 Total Calories Burned: <span class="text-xl">{{ $burned }}</span> kcal
        </div>
    @endisset
</div>

<!-- 📘 Explanation -->
<div class="max-w-3xl mx-auto mt-10 bg-gradient-to-br from-orange-50 to-yellow-100 p-6 rounded-lg shadow animate-fade-in">
    <h3 class="text-2xl font-bold text-yellow-900 mb-3">What Are Calories Burned?</h3>
    <p class="text-sm text-gray-700">
        Calories burned are the total energy your body uses during physical activity. This energy comes from two primary sources:
        <ul class="list-disc ml-5 mt-2 text-sm text-gray-700">
            <li><strong>Fat Calories</strong>: Calories burned from stored fat</li>
            <li><strong>Glycogen Calories</strong>: Calories burned from carbohydrate stores (muscle/liver glycogen)</li>
        </ul>
    </p>
    <p class="text-sm text-gray-700 mt-2">
        The balance of fat vs. glycogen used depends on the intensity of your exercise. Lower intensity burns more fat, while higher intensity burns more glycogen (and more total calories).
    </p>
</div>

<!-- 📊 Fat Burning Zone Table -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h3 class="text-xl font-bold text-purple-800 mb-4">🔥 The Fat Burning Zone (for 30 mins)</h3>

    <table class="w-full text-sm border table-auto">
        <thead class="bg-purple-100 text-purple-900">
            <tr>
                <th class="border px-3 py-2">Intensity Group</th>
                <th class="border px-3 py-2">Fat Calories Burned</th>
                <th class="border px-3 py-2">Glycogen Calories Burned</th>
                <th class="border px-3 py-2">Total Calories Burned</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <tr>
                <td class="border px-3 py-2">Low Intensity (50%)</td>
                <td class="border px-3 py-2">120</td>
                <td class="border px-3 py-2">80</td>
                <td class="border px-3 py-2">200</td>
            </tr>
            <tr class="bg-yellow-50 font-semibold">
                <td class="border px-3 py-2">High Intensity (75%)</td>
                <td class="border px-3 py-2">140</td>
                <td class="border px-3 py-2">260</td>
                <td class="border px-3 py-2">400</td>
            </tr>
        </tbody>
    </table>
</div>
</x-app-layout>
