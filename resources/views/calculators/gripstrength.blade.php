<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h2 class="text-3xl font-bold mb-4 text-purple-700">✊ Grip Strength Calculator</h2>
    <p class="text-gray-600 mb-4">
        Grip strength is the measure of force exerted by your hand and forearm muscles. It’s a proxy for overall strength and neuromuscular health.
    </p>

    <form method="POST" action="{{ route('calculator.gripStrength.calculate') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <select name="gender" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <input type="number" name="age" placeholder="Age" class="w-full border rounded px-3 py-2" required>

            <input type="number" name="grip_value" placeholder="Grip Strength (kg)" class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">
            Calculate
        </button>
    </form>

    @isset($score)
        <div class="mt-6 p-4 bg-blue-100 rounded text-blue-800 font-semibold text-center">
            💪 Your Grip Strength is: <span class="text-xl">{{ $score }} kg</span><br>
            🧠 Classification: <span class="text-lg text-purple-700 font-bold">{{ $classification ?? '?' }}</span>
        </div>
    @endisset
</div>

<!-- 📘 What Is Grip Strength -->
<div class="max-w-3xl mx-auto mt-10 bg-gradient-to-br from-yellow-50 to-lime-100 p-6 rounded-lg shadow animate-fade-in">
    <h3 class="text-2xl font-bold text-yellow-900 mb-3">What Is Grip Strength?</h3>
    <p class="text-sm text-gray-700">
        Grip strength measures the force your hand and forearm can exert when squeezing something. It's tested with a dynamometer and reflects full-body strength and overall health.
    </p>
</div>

<!-- 🧪 Measurement Procedure -->
<div class="max-w-3xl mx-auto mt-6 bg-white p-5 rounded shadow-md">
    <h3 class="text-lg font-semibold text-purple-800 mb-2">🧪 How to Measure Grip Strength (ACSM Guidelines)</h3>
    <ul class="list-disc ml-5 text-sm text-gray-700 space-y-1">
        <li>Use a handgrip dynamometer (analog or digital)</li>
        <li>Adjust grip to fit hand size</li>
        <li>Stand upright, arm at side (not touching body)</li>
        <li>Squeeze maximally for 3–5 seconds</li>
        <li>Do 2 trials per hand; record highest score</li>
        <li>Average the best scores of both hands</li>
    </ul>
</div>

<!-- 📊 Norm Table -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h3 class="text-xl font-bold text-purple-800 mb-4">📊 Grip Strength Norms by Age and Gender</h3>
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm border text-gray-700">
            <thead class="bg-purple-100 text-purple-800">
                <tr>
                    <th class="border px-2 py-1">Age (yrs)</th>
                    <th class="border px-2 py-1">Sex</th>
                    <th class="border px-2 py-1">Excellent</th>
                    <th class="border px-2 py-1">Very Good</th>
                    <th class="border px-2 py-1">Good</th>
                    <th class="border px-2 py-1">Fair</th>
                    <th class="border px-2 py-1">Poor</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $norms = [
                        ['15–19','M','≥ 49.0','44.5–48.5','40.8–44.0','35.8–40.4','≤ 35.4'],
                        ['15–19','F','≥ 30.8','27.2–30.4','24.0–26.8','21.8–23.6','≤ 21.3'],
                        ['20–29','M','≥ 52.2','47.2–51.7','43.1–46.7','38.1–42.6','≤ 37.6'],
                        ['20–29','F','≥ 31.8','28.6–31.3','26.3–28.1','23.6–25.9','≤ 23.1'],
                        ['30–39','M','≥ 52.2','47.2–51.7','43.1–46.7','38.1–42.6','≤ 37.6'],
                        ['30–39','F','≥ 32.2','28.6–31.8','26.3–28.1','23.1–25.9','≤ 22.7'],
                        ['40–49','M','≥ 49.0','44.0–48.5','39.9–43.5','36.3–39.5','≤ 35.8'],
                        ['40–49','F','≥ 31.3','27.7–30.8','24.5–27.2','22.2–24.0','≤ 21.8'],
                        ['50–59','M','≥ 45.8','41.7–45.4','38.1–41.3','34.5–37.6','≤ 34.0'],
                        ['50–59','F','≥ 27.7','24.5–27.2','22.2–24.0','20.4–21.8','≤ 20.0'],
                        ['60–69','M','≥ 45.4','41.3–44.9','38.1–40.8','33.1–37.6','≤ 32.7'],
                        ['60–69','F','≥ 24.5','21.8–24.0','20.4–21.3','18.6–20.0','≤ 18.1'],
                    ];
                @endphp

                @foreach ($norms as $row)
                    <tr>
                        @foreach ($row as $col)
                            <td class="border px-2 py-1">{{ $col }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
