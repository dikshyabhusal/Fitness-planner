<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-purple-700 leading-tight">
            {{ __('My Fitness Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Profile Sidebar -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=7e22ce&color=fff&size=128" alt="Avatar" class="mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-bold text-purple-800">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h4 class="text-purple-600 font-semibold mb-2">Fitness Details</h4>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li><strong>Gender:</strong> {{ auth()->user()->gender ?? 'N/A' }}</li>
                        <li><strong>Age:</strong> {{ auth()->user()->age ?? 'N/A' }}</li>
                        <li><strong>Height:</strong> {{ auth()->user()->height }} cm</li>
                        <li><strong>Weight:</strong> {{ auth()->user()->weight }} kg</li>
                        <li><strong>Goal:</strong>{{ auth()->user()->goal }} </li>
                        <li><strong>Activity Level:</strong> {{ auth()->user()->activity_level }}</li>
                        <li><strong>Daily Calorie Need:</strong> {{ auth()->user()->daily_calorie_need ?? 'N/A' }} kcal</li>
                    </ul>
                </div>
            </div>

            <!-- Update Forms -->
            <div class="md:col-span-2 space-y-10">

                <!-- Update Profile Info -->
                <div class="p-6 sm:p-8 bg-white shadow-lg rounded-2xl border border-purple-200">
                    <h3 class="text-2xl font-bold text-purple-600 mb-4">Update Profile Information</h3>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="p-6 sm:p-8 bg-white shadow-lg rounded-2xl border border-purple-200">
                    <h3 class="text-2xl font-bold text-purple-600 mb-4">Update Password</h3>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="p-6 sm:p-8 bg-white shadow-lg rounded-2xl border border-red-300">
                    <h3 class="text-2xl font-bold text-red-600 mb-4">Delete Account</h3>
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
