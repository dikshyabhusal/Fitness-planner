<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-purple-700 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-[#f3f4f6] to-[#e5e7eb] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

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
</x-app-layout>
