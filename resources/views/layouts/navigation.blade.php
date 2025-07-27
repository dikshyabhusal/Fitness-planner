<!-- Include Inter font in your layout's <head> section -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

<!-- Navbar -->
<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-950 via-purple-800 to-purple-700 text-white shadow-md sticky top-0 z-50 font-['Inter']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold tracking-wide text-purple-300">
                    Fitness<span class="text-white">Planner</span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
                
                @role('student')
                <x-nav-link :href="route('diet.recommend.form')" :active="request()->routeIs('diet.recommend.form')" class="hover:text-purple-300">RECOMMEND DIET</x-nav-link>
                @endrole
                @role('trainer')
                <li x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="#" @click.prevent="open = !open" class="hover:text-purple-300 cursor-pointer">CREATE</a>
                    <ul x-show="open" x-transition class="absolute mt-2 bg-white text-gray-800 rounded shadow-md w-64 z-50 text-sm">
                        <li><x-nav-link :href="route('diet.step1.form')" :active="request()->routeIs('diet.step1.form')">CREATE DIET PLAN</x-nav-link></li>
                        <li><x-nav-link :href="route('trainer.workout_plans.index')" :active="request()->routeIs('trainer.workout_plans*')" class="hover:text-purple-300">CREATE WORKOUT PLAN</x-nav-link></li>
                        <li><x-nav-link :href="route('videos.create')" :active="request()->routeIs('videos.create*')" class="hover:text-purple-300">CREATE VIDEO</x-nav-link></li>
                    </ul>
                </li>
                @endrole
                @role('student')
                <!-- Calculations Dropdown -->
                <li x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="#" @click.prevent="open = !open" class="hover:text-purple-300 cursor-pointer">CALCULATE</a>
                    <ul x-show="open" x-transition class="absolute mt-2 bg-white text-gray-800 rounded shadow-md w-64 z-50 text-sm">
                        <li><x-nav-link :href="route('calculator.bmi')" :active="request()->routeIs('calculator.bmi')">BODY MASS INDEX (BMI)</x-nav-link></li>
                        <li><x-nav-link :href="route('calculator.bodyFat')" :active="request()->routeIs('calculator.bodyFat')">BODY FAT INDEX (BFI)</x-nav-link></li>
                        <li><x-nav-link :href="route('calculator.caloriesBurned')" :active="request()->routeIs('calculator.caloriesBurned')">CALORIES BURNED</x-nav-link></li>
                        <li><x-nav-link :href="route('calculator.dailyCalorie')" :active="request()->routeIs('calculator.dailyCalorie')">DAILY CALORIE CALCULATOR</x-nav-link></li>
                        <li><x-nav-link :href="route('calculator.oneRepMax')" :active="request()->routeIs('calculator.oneRepMax')">ONE REP MAX CALCULATOR</x-nav-link></li>
                        <li><x-nav-link :href="route('calculator.gripStrength')" :active="request()->routeIs('calculator.gripStrength')">GRIP STRENGTH CALCULATOR</x-nav-link></li>
                    </ul>
                </li>
                @endrole

                

                @role('student')
                    <x-nav-link :href="route('student.workout_plans.index')" :active="request()->routeIs('student.workout_plans*')" class="hover:text-purple-300">VIEW WORKOUTS</x-nav-link>
                    <x-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.index*')" class="hover:text-purple-300">WATCH VIDEOS</x-nav-link>
                @endrole
                <x-nav-link :href="route('contact.show')" :active="request()->routeIs('contact*')" class="hover:text-purple-300">CONTACT US</x-nav-link>
            </div>

            <!-- Notifications & User Dropdown -->
            <div class="hidden md:flex items-center space-x-4">
                <livewire:notification-component />
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">PROFILE</x-dropdown-link>
                        @role('student')
                            <x-dropdown-link :href="route('student.saved.data')">VIEW SAVED DATA</x-dropdown-link>
                        @endrole
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">LOG OUT</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="focus:outline-none text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden bg-purple-800 text-white font-medium">
        <div class="px-4 py-4 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('aboutauth')" :active="request()->routeIs('aboutauth*')">About</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.show')" :active="request()->routeIs('contact*')">Contact</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile*')">Profile</x-responsive-nav-link>

            @role('trainer')
                <x-responsive-nav-link :href="route('trainer.workout_plans.index')" :active="request()->routeIs('trainer.workout_plans*')">Workout Plans</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('videos.create')" :active="request()->routeIs('videos.create*')">Upload Video</x-responsive-nav-link>
            @endrole

            @role('student')
                <x-responsive-nav-link :href="route('student.workout_plans.index')" :active="request()->routeIs('student.workout_plans*')">View Workouts</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.index*')">Watch Video</x-responsive-nav-link>
            @endrole

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
