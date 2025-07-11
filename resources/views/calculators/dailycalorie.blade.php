<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h2 class="text-3xl font-bold mb-4 text-purple-700">🍽️ Daily Calorie Calculator</h2>
    <p class="text-gray-600 mb-6">Calculate your caloric needs based on your personal info and activity level. Choose a goal to gain or lose weight efficiently.</p>

    <form method="POST" action="{{ route('calculator.dailyCalorie.calculate') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input type="number" name="age" placeholder="Age" required class="w-full border rounded px-3 py-2">
            <select name="gender" required class="w-full border rounded px-3 py-2">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <input type="number" name="weight" placeholder="Weight (kg)" required class="w-full border rounded px-3 py-2">
            <input type="number" name="height" placeholder="Height (cm)" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <select name="activity" required class="w-full border rounded px-3 py-2">
                <option value="">Activity Level</option>
                <option value="1.2">Sedentary</option>
                <option value="1.375">Lightly Active</option>
                <option value="1.55">Moderately Active</option>
                <option value="1.725">Very Active</option>
                <option value="1.9">Super Active</option>
            </select>

            <select name="goal" required class="w-full border rounded px-3 py-2">
                <option value="">Goal</option>
                <option value="maintain">Maintain Weight</option>
                <option value="lose">Lose Weight</option>
                <option value="gain">Gain Muscle</option>
            </select>
        </div>

        <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">Calculate</button>
    </form>

    @isset($calories)
        <div class="mt-6 p-4 bg-green-100 rounded text-green-800 font-semibold text-center">
            Target Daily Caloric Intake: <span class="text-xl">{{ $calories }} kcal</span>
        </div>
    @endisset
</div>

<!-- 🔍 Educational Explanation -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-gradient-to-br from-green-50 to-blue-100 rounded-lg shadow animate-fade-in">
    <h3 class="text-xl font-bold mb-3 text-green-800">Understanding Caloric Needs</h3>
    <p class="text-sm text-gray-800 mb-2">A calorie is a unit of energy. The body uses energy to move, function, and maintain temperature. The nutrients we eat are converted into energy. Excess calories are stored as fat.</p>
    
    <p class="text-sm text-gray-800 font-medium">Key Facts:</p>
    <ul class="list-disc ml-5 text-sm text-gray-700 space-y-1">
        <li>1g Carbohydrate = 4 calories</li>
        <li>1g Protein = 4 calories</li>
        <li>1g Fat = 9 calories</li>
        <li>7700 Calories = 1 Kg fat</li>
    </ul>
    <p class="text-sm text-gray-600 mt-2">So, to lose 1kg of fat, you must burn 7700 calories more than you consume.</p>
</div>

<!-- 📊 Food Calorie Tables -->
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
    <h3 class="text-xl font-bold text-purple-800 mb-4">Calories in Common Foods</h3>

    <!-- Fruits -->
    <h4 class="font-semibold text-purple-700 mt-4 mb-2">Fruits</h4>
    <table class="w-full text-sm table-auto border">
        <thead class="bg-purple-100">
            <tr><th class="px-2 py-1 border">Food</th><th class="px-2 py-1 border">Size</th><th class="px-2 py-1 border">Calories</th></tr>
        </thead>
        <tbody>
            <tr><td class="border px-2 py-1">Apple</td><td class="border px-2 py-1">1 small</td><td class="border px-2 py-1">80</td></tr>
            <tr><td class="border px-2 py-1">Banana</td><td class="border px-2 py-1">1 medium</td><td class="border px-2 py-1">101</td></tr>
            <tr><td class="border px-2 py-1">Orange</td><td class="border px-2 py-1">1</td><td class="border px-2 py-1">71</td></tr>
            <tr><td class="border px-2 py-1">Strawberry</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">53</td></tr>
        </tbody>
    </table>

    <!-- Foods -->
    <h4 class="font-semibold text-purple-700 mt-4 mb-2">Other Foods</h4>
    <table class="w-full text-sm table-auto border">
        <thead class="bg-purple-100">
            <tr><th class="px-2 py-1 border">Food</th><th class="px-2 py-1 border">Size</th><th class="px-2 py-1 border">Calories</th></tr>
        </thead>
        <tbody>
            <tr><td class="border px-2 py-1">Bread</td><td class="border px-2 py-1">1 slice</td><td class="border px-2 py-1">75</td></tr>
            <tr><td class="border px-2 py-1">Beef</td><td class="border px-2 py-1">1 slice</td><td class="border px-2 py-1">120</td></tr>
            <tr><td class="border px-2 py-1">Egg</td><td class="border px-2 py-1">1 large</td><td class="border px-2 py-1">79</td></tr>
            <tr><td class="border px-2 py-1">Pizza</td><td class="border px-2 py-1">1 slice</td><td class="border px-2 py-1">180</td></tr>
            <tr><td class="border px-2 py-1">Hamburger</td><td class="border px-2 py-1">1</td><td class="border px-2 py-1">280</td></tr>
        </tbody>
    </table>

    <!-- Vegetables -->
    <h4 class="font-semibold text-purple-700 mt-4 mb-2">Vegetables</h4>
    <table class="w-full text-sm table-auto border">
        <thead class="bg-purple-100">
            <tr><th class="px-2 py-1 border">Food</th><th class="px-2 py-1 border">Size</th><th class="px-2 py-1 border">Calories</th></tr>
        </thead>
        <tbody>
            <tr><td class="border px-2 py-1">Broccoli</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">40</td></tr>
            <tr><td class="border px-2 py-1">Carrots</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">45</td></tr>
            <tr><td class="border px-2 py-1">Eggplant</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">38</td></tr>
            <tr><td class="border px-2 py-1">Lettuce</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">7</td></tr>
        </tbody>
    </table>

    <!-- Beverages -->
    <h4 class="font-semibold text-purple-700 mt-4 mb-2">Beverages</h4>
    <table class="w-full text-sm table-auto border">
        <thead class="bg-purple-100">
            <tr><th class="px-2 py-1 border">Drink</th><th class="px-2 py-1 border">Size</th><th class="px-2 py-1 border">Calories</th></tr>
        </thead>
        <tbody>
            <tr><td class="border px-2 py-1">Coca-Cola</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">97</td></tr>
            <tr><td class="border px-2 py-1">Diet Coke</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">3</td></tr>
            <tr><td class="border px-2 py-1">Low-Fat Milk</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">104</td></tr>
            <tr><td class="border px-2 py-1">Milk</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">150</td></tr>
            <tr><td class="border px-2 py-1">Orange Juice</td><td class="border px-2 py-1">1 cup</td><td class="border px-2 py-1">115</td></tr>
        </tbody>
    </table>
</div>
</x-app-layout>
