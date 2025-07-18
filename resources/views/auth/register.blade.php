<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 to-purple-800 px-4 py-12">
        <div class="max-w-5xl w-full bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Left: Image Panel -->
            <div class="bg-gradient-to-br from-purple-700 to-purple-900 text-white p-10 flex items-center justify-center">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4">Welcome to</h2>
                    <h1 class="text-4xl font-extrabold leading-tight mb-2">Fitness Planner</h1>
                    <p class="text-lg">Track, Train & Transform.</p>
                </div>
            </div>

            <!-- Right: Registration Form -->
            <div class="p-8 sm:p-12">
                <h2 class="text-2xl font-bold text-purple-800 mb-6 text-center">Create Your Fitness Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select name="gender" id="gender" class="block mt-1 w-full">
                            <option value="">Please choose</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                    </div>

                    <!-- Age -->
                    <div class="mb-4">
                        <x-input-label for="age" :value="__('Age')" />
                        <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" min="10" />
                        <x-input-error :messages="$errors->get('age')" class="mt-1" />
                    </div>

                    <!-- Height -->
                    <div class="mb-4">
                        <x-input-label for="height" :value="__('Height (cm)')" />
                        <x-text-input id="height" class="block mt-1 w-full" type="number" name="height" step="0.1" />
                        <x-input-error :messages="$errors->get('height')" class="mt-1" />
                    </div>

                    <!-- Weight -->
                    <div class="mb-4">
                        <x-input-label for="weight" :value="__('Weight (kg)')" />
                        <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" step="0.1" />
                        <x-input-error :messages="$errors->get('weight')" class="mt-1" />
                    </div>

                    <!-- Goal -->
                    <div class="mb-4">
                        <x-input-label for="goal" :value="__('Goal')" />
                        <select name="goal" id="goal" class="block mt-1 w-full">
                            <option value="">Select goal</option>
                            <option value="Loose Weight">Loose Weight</option>
                            <option value="Gain Weight">Gain Weight</option>
                            <option value="Muscle Gain">Muscle Gain</option>
                            <option value="Maintainance">Maintainance</option>
                        </select>
                        {{-- <x-text-input id="goal" class="block mt-1 w-full" type="text" name="goal" /> --}}
                        <x-input-error :messages="$errors->get('goal')" class="mt-1" />
                    </div>

                    <!-- Activity Level -->
                    <div class="mb-4">
                        <x-input-label for="activity_level" :value="__('Activity Level')" />
                        <select name="activity_level" id="activity_level" class="block mt-1 w-full">
                            <option value="">Select Activity Level</option>
                            <option value="sedentary">Sedentary</option>
                            <option value="light">Lightly Active</option>
                            <option value="moderate">Moderately Active</option>
                            <option value="active">Very Active</option>
                        </select>
                        <x-input-error :messages="$errors->get('activity_level')" class="mt-1" />
                    </div>

                    <!-- Daily Calorie Need -->
                    <div class="mb-4">
                        <x-input-label for="daily_calorie_need" :value="__('Daily Calorie Need')" />
                        <x-text-input id="daily_calorie_need" class="block mt-1 w-full" type="number" name="daily_calorie_need" />
                        <x-input-error :messages="$errors->get('daily_calorie_need')" class="mt-1" />
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <x-input-label for="role" :value="__('Register as')" />
                        <select name="role" id="role" required class="block mt-1 w-full">
                            <option value="student">Student</option>
                            <option value="trainer">Trainer</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between">
                        <a class="text-sm text-purple-700 hover:underline" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ml-4 bg-purple-700 hover:bg-purple-800 text-white px-6 py-2">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
