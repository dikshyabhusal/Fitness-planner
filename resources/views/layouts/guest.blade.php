<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Navbar -->
<header class="bg-[#0f1b2e] text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="text-2xl font-extrabold text-purple-400">
                <a href="{{ route('dashboard') }}">Fitness<span class="text-white">Planner</span></a>
            </div>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-purple-300 transition">Home</a>
                <a href="{{ route('about') }}" class="hover:text-purple-300 transition">About</a>
                <a href="#categories" class="hover:text-purple-300 transition">Categories</a>
                <a href="#plans" class="hover:text-purple-300 transition">Plans</a>
                <a href="#contact" class="hover:text-purple-300 transition">Contact</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="hidden md:flex space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-white text-purple-800 hover:bg-purple-100 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-purple-600 hover:bg-purple-700 transition">Register</a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2 bg-[#0f1b2e] text-sm">
        <a href="{{ route('dashboard') }}" class="block hover:text-purple-300">Home</a>
        <a href="{{ route('about') }}" class="block hover:text-purple-300">About</a>
        <a href="#categories" class="block hover:text-purple-300">Categories</a>
        <a href="#plans" class="block hover:text-purple-300">Plans</a>
        <a href="#contact" class="block hover:text-purple-300">Contact</a>
        <div class="flex flex-col space-y-2 pt-2">
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-white text-purple-800 hover:bg-purple-100 transition text-center">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-purple-600 hover:bg-purple-700 transition text-center">Register</a>
        </div>
    </div>
</header>

        <div class="min-h-screen bg-gray-100">
            

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
    </body>
</html>
