<x-app-layout>
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Body Mass Index (BMI)</h2>
    <form method="POST" action="{{ route('calculator.bmi.calculate') }}" class="space-y-4">
        @csrf
        <input type="number" name="weight" placeholder="Weight (kg)" required class="w-full border rounded px-3 py-2">
        <input type="number" name="height_cm" placeholder="Height (cm)" class="w-full border rounded px-3 py-2">
        <div class="flex gap-2">
            <input type="number" name="height_ft" placeholder="Feet" class="w-1/2 border rounded px-3 py-2">
            <input type="number" name="height_in" placeholder="Inches" class="w-1/2 border rounded px-3 py-2">
        </div>
        <button class="bg-purple-600 text-white px-4 py-2 rounded">Calculate</button>
    </form>
    @isset($bmi)
        <p class="mt-4">Your BMI: <strong>{{ $bmi }}</strong> ({{ $category }})</p>
    @endisset
</div>

<!-- 📘 BMI Explanation -->
<!-- 📘 BMI Explanation -->
<div class="mt-10 bg-gradient-to-br from-blue-100 to-purple-100 p-6 rounded-xl shadow-xl animate-fade-in">
    <h3 class="text-2xl font-bold text-purple-900 mb-4 flex items-center gap-2">
        🧮 What is BMI?
    </h3>
    <p class="text-gray-800 text-sm leading-relaxed">
        BMI (Body Mass Index) is a number calculated using your height and weight. It gives a quick snapshot of your health based on your weight category.
    </p>

    <ul class="list-disc mt-4 ml-6 space-y-1 text-sm text-gray-700">
        <li><strong>Formula:</strong> BMI = weight (kg) / height² (m²)</li>
        <li><span class="inline-block px-2 py-1 bg-blue-200 text-blue-900 rounded text-xs font-medium">Underweight</span>: Below 18.5</li>
        <li><span class="inline-block px-2 py-1 bg-green-200 text-green-900 rounded text-xs font-medium">Normal weight</span>: 18.5 – 24.9</li>
        <li><span class="inline-block px-2 py-1 bg-yellow-200 text-yellow-900 rounded text-xs font-medium">Overweight</span>: 25 – 29.9</li>
        <li><span class="inline-block px-2 py-1 bg-red-200 text-red-900 rounded text-xs font-medium">Obese</span>: 30 and above</li>
    </ul>

    <div class="mt-6 space-y-3 text-sm text-gray-700">
        <p>
            <strong>🟦 BMI below 18.5:</strong> You're underweight. This may indicate nutritional deficiency or other issues. Consult a healthcare provider.
        </p>
        <p>
            <strong>🟩 BMI 18.5 – 24.9:</strong> You're in the healthy range! Keep maintaining your lifestyle.
        </p>
        <p>
            <strong>🟨 BMI 25 – 29.9:</strong> You're overweight. Consider improving your diet and increasing physical activity.
        </p>
        <p>
            <strong>🟥 BMI 30 and above:</strong> You're in the obese category. You’re at higher risk for heart disease, diabetes, and more.
        </p>
        <p>
            ⚠️ Individuals with BMI over 25 and waist size above <strong>40” (men)</strong> or <strong>35” (women)</strong> are at especially high risk for health issues.
        </p>
    </div>
</div>

</x-app-layout>
