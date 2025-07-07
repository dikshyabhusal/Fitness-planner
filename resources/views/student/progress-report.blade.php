<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">📊 Progress Report: {{ $plan->title }}</h2>

        <div class="mb-4">
            <p>✅ Workout Completion: <strong>{{ $percentWorkout }}%</strong></p>
            <p>🥗 Diet Completion: <strong>{{ $percentDiet }}%</strong></p>
        </div>

        <canvas id="progressChart" height="100"></canvas>

        <a href="{{ route('student.workout_plans.show', $plan->id) }}" class="inline-block mt-6 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            🔙 Back to Workout Plan
        </a>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Workout Done',
                        data: {!! json_encode($workoutData) !!},
                        backgroundColor: 'rgba(96, 165, 250, 0.7)'
                    },
                    {
                        label: 'Diet Followed',
                        data: {!! json_encode($dietData) !!},
                        backgroundColor: 'rgba(74, 222, 128, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: val => val === 1 ? '✔' : '❌'
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
