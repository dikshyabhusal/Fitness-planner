<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-700 to-purple-900 py-12 px-4 sm:px-6 lg:px-8 text-white">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold text-center mb-4">Admin Dashboard</h1>
            <p class="text-center text-indigo-200 mb-12 text-lg">Manage users, roles, trainers, students, and system-wide reports</p>

            <!-- Admin Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Users -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">User Management</h2>
                    <p class="text-sm text-indigo-200">View, edit, or delete users and manage their profiles.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">Manage Users →</a>
                </div>

                <!-- Roles -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Roles & Permissions</h2>
                    <p class="text-sm text-indigo-200">Control access by assigning roles like admin, trainer, and student.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">Manage Roles →</a>
                </div>

                <!-- Trainer Accounts -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Trainer Profiles</h2>
                    <p class="text-sm text-indigo-200">View all registered trainers and their assigned clients.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">View Trainers →</a>
                </div>

                <!-- Student Accounts -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Student Profiles</h2>
                    <p class="text-sm text-indigo-200">Access student data, track progress, or reset passwords.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">View Students →</a>
                </div>

                <!-- System Reports -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">System Reports</h2>
                    <p class="text-sm text-indigo-200">View site activity logs, usage analytics, and error reports.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">View Reports →</a>
                </div>

                <!-- Settings -->
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Platform Settings</h2>
                    <p class="text-sm text-indigo-200">Update global platform configurations and app metadata.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-300 hover:text-white font-medium">Open Settings →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
