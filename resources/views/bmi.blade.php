<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">💪 BMI Calculator</h2>

        <!-- Alpine.js required -->
        <script src="https://unpkg.com/alpinejs" defer></script>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('bmi.calculate') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Weight (kg)</label>
                <input type="number" name="weight" step="0.1" required class="w-full border rounded px-3 py-2" value="{{ old('weight') }}">
            </div>

            <div>
                <label class="block font-semibold">Age</label>
                <input type="number" name="age" required class="w-full border rounded px-3 py-2" value="{{ old('age') }}">
            </div>

            <!-- Height Input -->
            <div x-data="{ unit: 'cm' }">
                <label class="block font-semibold mb-1">Height</label>

                <select x-model="unit" class="border rounded px-3 py-2 mb-2 w-full">
                    <option value="cm">Centimeters (cm)</option>
                    <option value="ft">Feet/Inches (ft/in)</option>
                </select>

                <!-- cm -->
                <div x-show="unit === 'cm'" x-cloak>
                    <input type="number" name="height_cm" step="0.1" placeholder="Enter height in cm"
                           class="w-full border rounded px-3 py-2" value="{{ old('height_cm') }}">
                </div>

                <!-- ft/in -->
                <div x-show="unit === 'ft'" class="flex gap-2 mt-2" x-cloak>
                    <input type="number" name="height_ft" placeholder="Feet"
                           class="w-1/2 border rounded px-3 py-2" value="{{ old('height_ft') }}">
                    <input type="number" name="height_in" placeholder="Inches"
                           class="w-1/2 border rounded px-3 py-2" value="{{ old('height_in') }}">
                </div>
            </div>

            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded transition">
                Calculate BMI
            </button>
        </form>

        @if (isset($bmi))
            <div class="mt-6 p-4 bg-gray-100 rounded text-center">
                <h3 class="text-xl font-bold">Your BMI is: {{ $bmi }}</h3>
                <p class="mt-2 font-semibold text-purple-700">Category: {{ $category }}</p>

                <div class="mt-3">
                    @if ($bmi < 18.5)
                        <p class="text-yellow-600">You are underweight. Consider a nutritious diet.</p>
                    @elseif ($bmi < 25)
                        <p class="text-green-600">You have a normal weight. Great job!</p>
                    @elseif ($bmi < 30)
                        <p class="text-orange-600">You are overweight. Consider physical activity.</p>
                    @else
                        <p class="text-red-600">You are obese. Consult with a health professional.</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
