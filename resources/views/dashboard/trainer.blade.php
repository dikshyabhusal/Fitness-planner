<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-purple-700 to-purple-900 min-h-screen text-white">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold mb-6 text-center text-white">Welcome, Trainer!</h1>
            <p class="text-lg text-purple-200 text-center mb-10">Manage your fitness plans, track your students, and guide them to transformation.</p>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- My Clients -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">My Clients</h2>
                    <p class="text-sm text-purple-200">View and manage all your assigned students and their progress.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">View Clients →</a>
                </div>

                <!-- Create Workout Plan -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Create Workout Plan</h2>
                    <p class="text-sm text-purple-200">Design customized workout routines tailored to each student.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">Start Planning →</a>
                </div>

                <!-- Nutrition Guides -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Nutrition Guides</h2>
                    <p class="text-sm text-purple-200">Upload or assign meal plans to help clients meet their goals.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">Add Guide →</a>
                </div>

                <!-- Progress Reports -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Progress Reports</h2>
                    <p class="text-sm text-purple-200">Monitor student improvements and weekly performance.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">View Reports →</a>
                </div>

                <!-- Appointments -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Session Schedule</h2>
                    <p class="text-sm text-purple-200">Plan and view upcoming training sessions with students.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">Manage Sessions →</a>
                </div>

                <!-- Feedback -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">Feedback & Reviews</h2>
                    <p class="text-sm text-purple-200">Read client feedback and continuously improve your sessions.</p>
                    <a href="#" class="mt-4 inline-block text-purple-300 hover:text-white font-medium">Check Feedback →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
