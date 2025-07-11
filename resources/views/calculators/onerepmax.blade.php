<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h2 class="text-3xl font-bold mb-4 text-purple-700">🏋️ One-Rep Max (1RM) Calculator</h2>
    <p class="text-gray-600 mb-6">
        One-rep max (1RM) is the maximum weight a person can lift for a single repetition in a specific exercise. It’s not just a number; it’s a valuable tool that can shape your workout routine and help you reach fitness goals more effectively.
    </p>

    <form method="POST" action="{{ route('calculator.oneRepMax.calculate') }}" class="space-y-4">
        @csrf
        <input type="number" name="weight" placeholder="Weight Lifted (kg)" required class="w-full border rounded px-3 py-2">
        <input type="number" name="reps" placeholder="Number of Reps" required class="w-full border rounded px-3 py-2">
        <button class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">
            Calculate
        </button>
    </form>

    @isset($orm)
        <div class="mt-6 p-4 bg-green-100 rounded text-green-800 font-semibold text-center">
            💪 Your One-Rep Max is: <span class="text-xl">{{ $orm }} kg</span>
        </div>
    @endisset
</div>

<!-- 📘 Explanation of 1RM -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-gradient-to-br from-blue-100 to-purple-50 rounded-lg shadow animate-fade-in">
    <h3 class="text-2xl font-bold text-purple-900 mb-4">What is One-Rep Max?</h3>
    <p class="text-sm text-gray-800 mb-3">
        Your 1RM (one-repetition maximum) is the most weight you can lift in a single repetition of an exercise (e.g., bench press, squat, deadlift). For example, if you bench 90 kg for 5 reps, this calculator estimates your 1RM.
    </p>

    <p class="text-sm text-gray-800 mb-1 font-medium">Formula:</p>
    <p class="text-sm text-gray-700 mb-3">Weight × (1 + reps ÷ 30)</p>

    <p class="text-sm text-gray-800 mb-4">
        Knowing your 1RM allows you to train smarter by selecting the correct weight ranges for various fitness goals such as strength, endurance, and hypertrophy.
    </p>
</div>

<!-- 📊 How to Use 1RM in Training -->
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
    <h3 class="text-xl font-bold text-purple-800 mb-4">🎯 How to Use 1RM in Your Workouts</h3>
    <p class="text-sm text-gray-700 mb-4">
        These guidelines help you design training programs tailored to your goals. Adjust sets, reps, intensity, and rest based on your fitness level and target outcome.
    </p>

    <table class="w-full text-sm border table-auto mb-4">
        <thead class="bg-purple-100 text-purple-900">
            <tr>
                <th class="border px-3 py-2">Training Goal</th>
                <th class="border px-3 py-2">Sets</th>
                <th class="border px-3 py-2">Reps</th>
                <th class="border px-3 py-2">Rest</th>
                <th class="border px-3 py-2">Intensity (% of 1RM)</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <tr>
                <td class="border px-3 py-2">General Fitness</td>
                <td class="border px-3 py-2">1–3</td>
                <td class="border px-3 py-2">12–15</td>
                <td class="border px-3 py-2">30–90 sec</td>
                <td class="border px-3 py-2">Varies</td>
            </tr>
            <tr>
                <td class="border px-3 py-2">Endurance</td>
                <td class="border px-3 py-2">2–4</td>
                <td class="border px-3 py-2">12–20</td>
                <td class="border px-3 py-2">≤ 30 sec</td>
                <td class="border px-3 py-2">&lt; 67%</td>
            </tr>
            <tr>
                <td class="border px-3 py-2">Hypertrophy</td>
                <td class="border px-3 py-2">3–6</td>
                <td class="border px-3 py-2">6–12</td>
                <td class="border px-3 py-2">30–90 sec</td>
                <td class="border px-3 py-2">60–85%</td>
            </tr>
            <tr>
                <td class="border px-3 py-2">Muscle Strength</td>
                <td class="border px-3 py-2">2–6</td>
                <td class="border px-3 py-2">&lt; 6</td>
                <td class="border px-3 py-2">2–5 min</td>
                <td class="border px-3 py-2">&gt; 85%</td>
            </tr>
            <tr>
                <td class="border px-3 py-2">Power (1–2 reps)</td>
                <td class="border px-3 py-2">3–5</td>
                <td class="border px-3 py-2">1–2</td>
                <td class="border px-3 py-2">2–5 min</td>
                <td class="border px-3 py-2">80–90%</td>
            </tr>
            <tr>
                <td class="border px-3 py-2">Muscle Power</td>
                <td class="border px-3 py-2">3–6</td>
                <td class="border px-3 py-2">1–3</td>
                <td class="border px-3 py-2">2–5 min</td>
                <td class="border px-3 py-2">30–60%</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- 🧠 Why 1RM Matters -->
<div class="max-w-3xl mx-auto mt-10 bg-gradient-to-bl from-indigo-100 to-purple-50 p-6 rounded-xl shadow-md">
    <h3 class="text-2xl font-bold text-indigo-900 mb-3">Why Should You Know Your 1RM?</h3>
    <ul class="list-disc ml-5 text-sm text-gray-700 space-y-2">
        <li><strong>Set Training Intensity:</strong> Plan workouts based on exact % of your strength level.</li>
        <li><strong>Track Progress:</strong> Reassess every few weeks to ensure gains and adjust weight.</li>
        <li><strong>Prevent Injury:</strong> Avoid overtraining and select realistic loads.</li>
        <li><strong>Set Realistic Goals:</strong> Know what you're aiming for—strength, endurance, or hypertrophy.</li>
        <li><strong>Apply Progressive Overload:</strong> Use 1RM as a foundation for scaling volume and difficulty.</li>
    </ul>
</div>
</x-app-layout>
