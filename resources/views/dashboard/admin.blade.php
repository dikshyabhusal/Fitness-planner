@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow text-center">
        <h2 class="text-gray-500 text-sm">Total Users</h2>
        <p class="text-3xl font-bold text-blue-600">{{ $userCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow text-center">
        <h2 class="text-gray-500 text-sm">Total Workout Plans</h2>
        <p class="text-3xl font-bold text-green-500">{{ $planCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow text-center">
        <h2 class="text-gray-500 text-sm">Total Diet Plans</h2>
        <p class="text-3xl font-bold text-pink-500">{{ $dietCount }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Users by Role -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">Users by Role</h2>
        <canvas id="roleChart" height="200"></canvas>
    </div>

    <!-- Workout Plans by Goal -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">Workout Plans by Goal</h2>
        <canvas id="workoutChart" height="200"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const roleChart = new Chart(document.getElementById('roleChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($userRoles->keys()) !!},
            datasets: [{
                label: 'Number of Users',
                data: {!! json_encode($userRoles->values()) !!},
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            }
        }
    });

    const workoutChart = new Chart(document.getElementById('workoutChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($workoutChart->keys()) !!},
            datasets: [{
                label: 'Workout Goals',
                data: {!! json_encode($workoutChart->values()) !!},
                backgroundColor: ['#f87171', '#34d399', '#60a5fa', '#fbbf24', '#a78bfa'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush
