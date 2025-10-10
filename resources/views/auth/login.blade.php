<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 to-purple-800 px-4 py-12">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-2xl p-10">
            <h2 class="text-3xl font-bold text-center text-purple-800 mb-8">Welcome Back</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="flex justify-end mb-4">
                    <x-primary-button class="bg-purple-700 hover:bg-purple-800 text-white px-6 py-2">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Register Link -->
                <div class="text-center text-sm">
                    <span class="text-gray-600">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-purple-600 hover:underline font-medium ml-1">
                        Register
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
