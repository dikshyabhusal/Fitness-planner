<x-app-layout>
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-extrabold text-purple-700">📋 My Workout Plans</h2>
        <a href="{{ route('trainer.workout_plans.create') }}"
           class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            + Add New Plan
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <div class="relative plan-card bg-white p-5 rounded-2xl shadow-md border hover:shadow-xl transition duration-300" data-tilt>
                
                <!-- Top right 3-dots menu -->
                <div class="absolute top-3 right-3">
                    <button onclick="toggleDropdown({{ $plan->id }})" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        ⋮
                    </button>
                    
                    <!-- Dropdown -->
                    <div id="dropdown-{{ $plan->id }}" 
                         class="hidden absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg z-20">
                        <a href="{{ route('trainer.workout_plans.edit', $plan->id) }}" 
                           class="block px-4 py-2 text-sm text-yellow-600 hover:bg-gray-100">✏️ Edit</a>
                        
                        <form action="{{ route('trainer.workout_plans.destroy', $plan->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this plan?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Workout Plan Info -->
                <h3 class="text-2xl font-bold text-purple-800 mb-2">{{ $plan->title }}</h3>
                <p class="text-sm text-gray-600 mb-3">🕒 Duration: <strong>{{ $plan->duration_days }} days</strong></p>
                <p class="text-sm text-gray-600 mb-4">👤 For: <strong>{{ ucfirst($plan->gender) }}</strong></p>

                <a href="{{ route('trainer.workout_plans.show', $plan->id) }}"
                   class="inline-block text-blue-600 font-medium hover:underline transition">
                    👁️ View Full Plan
                </a>
            </div>
        @empty
            <p class="text-gray-500 italic">You haven’t added any workout plans yet.</p>
        @endforelse
    </div>
</div>

<!-- VanillaTilt JS -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".plan-card"), {
        max: 15,
        speed: 300,
        glare: true,
        "max-glare": 0.3,
    });

    // Toggle dropdown menu
    function toggleDropdown(id) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el.id !== `dropdown-${id}`) el.classList.add('hidden'); // close others
        });
        document.getElementById(`dropdown-${id}`).classList.toggle('hidden');
    }

    // Close dropdown if clicked outside
    window.addEventListener('click', function(e) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (!el.contains(e.target) && !e.target.closest('button')) {
                el.classList.add('hidden');
            }
        });
    });
</script>
</x-app-layout>
