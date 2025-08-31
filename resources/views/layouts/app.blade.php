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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

    @auth
        @hasanyrole('trainer|student')
            @livewire('chat-popup')
        @endhasanyrole
    @endauth

    <!-- 🔹 Tip Popup -->
    <div id="tipPopup" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg max-w-sm text-center">
            <h3 class="text-lg font-bold mb-3">💡 Tip of the Day</h3>
            <p id="tipText" class="text-gray-700 dark:text-gray-300">Loading...</p>
            <button onclick="closeTip()" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg">
                Close
            </button>
        </div>
    </div>

    <script>
    async function fetchTip() {
        try {
            const res = await fetch("{{ route('tip.random') }}");
            const data = await res.json();

            if (data.status === 'success') {
                document.getElementById("tipText").innerText = data.tip;
            } else {
                document.getElementById("tipText").innerText = data.message;
            }

            openTip();
            // Save the timestamp of when the tip was shown
            localStorage.setItem('lastTipTime', Date.now());
        } catch (err) {
            console.error('Error fetching tip:', err);
            document.getElementById("tipText").innerText = 'Failed to load tip.';
            openTip();
        }
    }

    function openTip() {
        document.getElementById("tipPopup").classList.remove("hidden");
    }

    function closeTip() {
        document.getElementById("tipPopup").classList.add("hidden");
    }

    window.addEventListener("DOMContentLoaded", () => {
        const lastTipTime = localStorage.getItem('lastTipTime');
        const now = Date.now();

        // Show tip if:
        // 1) Never shown before
        // 2) Or 10 minutes have passed since last shown
        if (!lastTipTime || now - lastTipTime >= 600000) {
            fetchTip();
        }

        // Check every minute if 10 minutes have passed, then show tip again
        setInterval(() => {
            const last = localStorage.getItem('lastTipTime');
            const current = Date.now();
            if (!last || current - last >= 600000) {
                fetchTip();
            }
        }, 60000); // check every 1 minute
    });
</script>


    @livewireScripts
    @stack('scripts')

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
                    <li><a href="{{ route('aboutauth') }}" class="hover:text-purple-300">About</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-purple-300">Profile</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-purple-300">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-purple-300">Register</a></li>
                    <li><a href="{{ route('privacy.policy') }}" class="hover:text-purple-300">Privacy Policy</a></li>
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
