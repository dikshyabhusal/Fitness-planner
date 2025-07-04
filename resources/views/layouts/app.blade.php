<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
        </div>
        @hasanyrole('trainer|student')
            @livewire('chat-popup')
        @endhasanyrole

        @livewireScripts
        {{-- <script src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js" type="module"></script> --}}
        {{-- <script>
            Livewire.on('openChatWith', ({ senderId }) => {
                // Redirect trainer to chat page with that student
                window.location.href = `/trainer/chat/${senderId}`;
            });
        </script> --}}
    </body>
        <!-- Footer -->
<footer class="bg-[#0f1b2e] text-white mt-10">
    <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">
        <!-- About -->
        <div>
            <h2 class="text-xl font-semibold text-purple-400 mb-3">Fitness Planner</h2>
            <p class="text-gray-400 text-sm">
                Your personal workout planner – create routines, track progress, and meet your fitness goals. Designed for beginners to pros.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-lg font-semibold text-purple-400 mb-3">Quick Links</h2>
            <ul class="space-y-2 text-sm text-gray-300">
                <li><a href="{{ route('dashboard') }}" class="hover:text-purple-300">Dashboard</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-purple-300">About</a></li>
                <li><a href="{{ route('profile.edit') }}" class="hover:text-purple-300">Profile</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-purple-300">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-purple-300">Register</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h2 class="text-lg font-semibold text-purple-400 mb-3">Contact Us</h2>
            <p class="text-gray-300 text-sm">Email: <a href="mailto:mail@fitnessprogramer.com" class="underline hover:text-purple-300">mail@fitnessprogramer.com</a></p>
            <p class="text-gray-300 text-sm mt-2">Follow us on:</p>
            <div class="flex space-x-4 mt-2">
                <a href="#" class="hover:text-purple-300"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" class="hover:text-purple-300"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>

    <div class="text-center text-sm text-gray-500 border-t border-gray-700 py-4">
        &copy; {{ date('Y') }} Fitness Planner. All rights reserved.
    </div>
</footer>

    </body>
</html>
