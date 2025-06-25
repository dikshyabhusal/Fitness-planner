<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 to-purple-800 px-4 py-12">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-2xl p-10">
            <h2 class="text-3xl font-bold text-center text-purple-800 mb-6">Forgot Your Password?</h2>

            <p class="mb-6 text-sm text-gray-600 text-center">
                {{ __('No problem. Just enter your email and we’ll send you a link to reset your password.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <x-primary-button class="bg-purple-700 hover:bg-purple-800 text-white px-6 py-2">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
