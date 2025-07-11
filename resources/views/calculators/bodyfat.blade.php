<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h2 class="text-3xl font-bold mb-4 text-purple-700">🧮 Body Fat Calculator</h2>
    <p class="text-gray-600 mb-6">Use a tape measure to determine your waist, hip, and neck circumference. Then input your gender and measurements below to calculate an estimated body fat percentage.</p>

    <form method="POST" action="{{ route('calculator.bodyFat.calculate') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <select name="gender" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <input type="number" name="waist" placeholder="Waist (cm)" class="w-full border rounded px-3 py-2" required>
            <input type="number" name="hip" placeholder="Hip (cm)" class="w-full border rounded px-3 py-2">
            <input type="number" name="neck" placeholder="Neck (cm)" class="w-full border rounded px-3 py-2" required>
            <input type="number" name="weight" placeholder="Weight (kg)" class="w-full border rounded px-3 py-2" required>
            <input type="number" name="height" placeholder="Height (cm)" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">
            Calculate
        </button>
    </form>

    @isset($bfi)
    <div class="mt-6 p-4 bg-blue-100 rounded text-blue-800 font-semibold text-center">
        🎯 Your Body Fat is: <span class="text-xl">{{ $bfi }}%</span>
    </div>
    @endisset
</div>

<!-- 📘 Explanation Section -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-gradient-to-br from-red-50 to-yellow-100 rounded-lg shadow animate-fade-in">
    <h3 class="text-2xl font-bold text-red-900 mb-3">Understanding Body Fat Percentage</h3>
    <p class="text-gray-800 text-sm leading-relaxed mb-4">
        Body fat percentage refers to the percentage of your total body weight that is made up of fat. It's calculated using the US Navy method based on measurements of the waist, neck, hips (for women), height, and gender.
    </p>

    <ul class="list-disc ml-5 text-sm text-gray-700 space-y-1">
        <li>Men: Uses waist, neck, and height</li>
        <li>Women: Uses waist, neck, hips, and height</li>
        <li>More accurate than BMI for determining fitness level</li>
    </ul>
</div>

<!-- 📊 Body Fat Category Table -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h3 class="text-xl font-bold text-purple-800 mb-4">📊 Body Fat Percentage Categories</h3>
    <table class="w-full text-sm border table-auto">
        <thead class="bg-purple-100">
            <tr>
                <th class="px-3 py-2 border">Classification</th>
                <th class="px-3 py-2 border">Women (% Fat)</th>
                <th class="px-3 py-2 border">Men (% Fat)</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <tr>
                <td class="px-3 py-2 border">Essential Fat</td>
                <td class="px-3 py-2 border">10–13%</td>
                <td class="px-3 py-2 border">2–5%</td>
            </tr>
            <tr>
                <td class="px-3 py-2 border">Athletes</td>
                <td class="px-3 py-2 border">14–20%</td>
                <td class="px-3 py-2 border">6–13%</td>
            </tr>
            <tr>
                <td class="px-3 py-2 border">Fitness</td>
                <td class="px-3 py-2 border">21–24%</td>
                <td class="px-3 py-2 border">14–17%</td>
            </tr>
            <tr>
                <td class="px-3 py-2 border">Acceptable</td>
                <td class="px-3 py-2 border">25–31%</td>
                <td class="px-3 py-2 border">18–25%</td>
            </tr>
            <tr class="bg-red-50 text-red-700 font-semibold">
                <td class="px-3 py-2 border">Obese</td>
                <td class="px-3 py-2 border">32% and above</td>
                <td class="px-3 py-2 border">25% and above</td>
            </tr>
        </tbody>
    </table>
</div>
</x-app-layout>
