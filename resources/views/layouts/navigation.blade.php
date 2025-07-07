<nav x-data="{ open: false }" class="bg-gradient-to-r from-[#1a1a2e] via-[#16213e] to-[#0f3460] text-white shadow-lg sticky top-0 z-50 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold tracking-wide text-purple-400">
                    Fitness<span class="text-white">Planner</span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-8 items-center text-sm font-semibold">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-purple-300">
                    Dashboard
                </x-nav-link>
                <x-nav-link :href="route('aboutauth')" :active="request()->routeIs('aboutauth*')" class="hover:text-purple-300">
                    About
                </x-nav-link>
                <x-nav-link :href="route('contact.show')" :active="request()->routeIs('contact*')" class="hover:text-purple-300">
                    Contact Us
                </x-nav-link>
                {{-- <x-nav-link :href="route('diet.user.form')" :active="request()->routeIs('diet.user.form')" class="hover:text-purple-300">
                    My Diet Plan
                </x-nav-link> --}}
                <x-nav-link 
    :href="route('diet.step1.form')" 
    :active="request()->routeIs('diet.step1.form')" 
    class="hover:text-purple-300"
>
    My Diet Plan
</x-nav-link>


                {{-- <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-purple-300">Diet Categories ⌄</button>
                    <div x-show="open" @click.away="open = false" class="absolute bg-white text-black shadow rounded mt-2 z-50 p-2">
                        <a href="{{ route('diet.create') }}" class="block px-4 py-1 hover:bg-gray-100">➕ Add Diet Plan</a>
                        <a href="{{ route('diet.categories') }}" class="block px-4 py-1 hover:bg-gray-100">📂 View Categories</a>
                    </div>
                </div> --}}


                {{-- <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile*')" class="hover:text-purple-300">
                    Profile
                </x-nav-link> --}}

                @role('trainer')
                    <x-nav-link :href="route('trainer.workout_plans.index')" :active="request()->routeIs('trainer.workout_plans*')" class="hover:text-purple-300">
                        Workout Plans
                    </x-nav-link>
                @endrole

                @role('student')
                    <x-nav-link :href="route('student.workout_plans.index')" :active="request()->routeIs('student.workout_plans*')" class="hover:text-purple-300">
                        View Workouts
                    </x-nav-link>
                @endrole
            </div>

            <!-- Notification + User Dropdown -->
            <div class="hidden md:flex items-center space-x-3">
                
                <!-- Notification Bell -->
                <livewire:notification-component />

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md bg-purple-600 hover:bg-purple-700 text-white transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>
                        
                        @role('student')
                            <x-dropdown-link :href="route('student.saved.data')">
                                View Saved Data
                            </x-dropdown-link>
                        @endrole

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="focus:outline-none text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-[#16213e] text-sm font-medium">
        <div class="px-4 py-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('aboutauth')" :active="request()->routeIs('aboutauth*')">
                About
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.show')" :active="request()->routeIs('contact*')">
                Contact Us
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile*')">
                Profile
            </x-responsive-nav-link>

            @role('trainer')
                <x-responsive-nav-link :href="route('trainer.workout_plans.index')" :active="request()->routeIs('trainer.workout_plans*')">
                    Workout Plans
                </x-responsive-nav-link>
            @endrole

            @role('student')
                <x-responsive-nav-link :href="route('student.workout_plans.index')" :active="request()->routeIs('student.workout_plans*')">
                    View Workouts
                </x-responsive-nav-link>
            @endrole

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
