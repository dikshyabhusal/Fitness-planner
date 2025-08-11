<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Fitness Planner</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex bg-gray-100 min-h-screen text-gray-800">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg border-r min-h-screen flex flex-col justify-between fixed">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-purple-700 mb-8">🧠 Admin Panel</h2>

            <nav class="space-y-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-purple-700 font-medium transition">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.users') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    👥 All Users
                </a>
                <a href="{{ route('admin.workouts') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    🏋️‍♂️ Workout Plans
                </a>
                <a href="{{ route('admin.diets') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    🥗 Diet Plans
                </a>
                <a href="{{ route('admin.products.create') }}"
                class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    🛒 Add Product
                </a>
                <a href="{{ route('admin.products.index') }}"
                class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    📦 Manage Products
                </a>
                <a href="{{ route('admin.orders.index') }}"
                class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    📦 Manage Orders
                </a>

                <a href="{{ route('admin.reviews') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    💬 Feedback & Reviews
                </a>
                <a href="{{ route('admin.contacts') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-purple-100 text-gray-700 transition">
                    📞Contacts
                </a>
            </nav>
        </div>

        {{-- Profile Avatar Dropdown --}}
        <div class="relative p-6" x-data="{ open: false }">
            <button @click="open = !open"
                    class="w-12 h-12 bg-purple-600 text-white text-lg font-semibold rounded-full flex items-center justify-center focus:outline-none"
                    title="{{ Auth::user()->name }}">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(explode(' ', Auth::user()->name)[1][0] ?? '') }}
            </button>

            {{-- Dropdown Upward --}}
            <div x-show="open"
                 @click.away="open = false"
                 x-transition
                 class="absolute bottom-16 right-0 w-48 bg-white rounded-lg shadow-lg border z-50">
                <div class="py-2 text-sm text-gray-700">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 hover:bg-purple-100 transition">👤 Profile</a>

                    @role('student')
                        <a href="{{ route('student.saved.data') }}"
                           class="block px-4 py-2 hover:bg-purple-100 transition">🔖 Saved Data</a>
                    @endrole

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 hover:bg-purple-100 transition">🚪 Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 ml-64 p-8 overflow-y-auto">
        @yield('content')
    </main>
</body>
</html>
