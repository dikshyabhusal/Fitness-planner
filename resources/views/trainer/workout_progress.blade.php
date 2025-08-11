<x-app-layout>
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-purple-600 mb-6">
        Progress Report for "{{ $workout->title }}"
    </h1>

    @forelse($progressData as $studentId => $records)
        <div class="mb-8 p-6 bg-white/5 rounded-lg border border-purple-700 shadow-md">
            <!-- Student Name -->
            <h2 class="text-lg font-semibold text-purple-300 mb-4">
                {{ $records->first()->student->name }}
            </h2>

            <!-- Chart -->
            <canvas id="chart-{{ $studentId }}" height="100"></canvas>

            <!-- Detailed Progress Table -->
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full border border-purple-700 text-sm rounded-lg overflow-hidden">
                    <thead class="bg-purple-600 text-white">
                        <tr>
                            <th class="px-4 py-2 border border-purple-700">Date</th>
                            <th class="px-4 py-2 border border-purple-700">Workout Status</th>
                            <th class="px-4 py-2 border border-purple-700">Diet Status</th>
                            <th class="px-4 py-2 border border-purple-700">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/10">
                        @foreach($records as $record)
                            <tr>
                                <td class="px-4 py-2 border border-purple-700 text-gray-800 font-medium">
                                    {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 border border-purple-700">
                                    @if($record->workout_done)
                                        <span class="text-green-700 font-bold text-base">✅ Completed</span>
                                    @else
                                        <span class="text-red-700 font-bold text-base">❌ Not Done</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-purple-700">
                                    @if($record->diet_done)
                                        <span class="text-green-700 font-bold text-base">✅ Followed</span>
                                    @else
                                        <span class="text-red-700 font-bold text-base">❌ Not Followed</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-purple-700 text-gray-700">
                                    {{ $record->notes ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Chart Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('chart-{{ $studentId }}').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($records->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))) !!},
                            datasets: [
                                {
                                    label: 'Workout Done',
                                    data: {!! json_encode($records->pluck('workout_done')) !!},
                                    borderColor: 'rgba(147, 51, 234, 1)',
                                    backgroundColor: 'rgba(147, 51, 234, 0.2)',
                                    fill: true,
                                    tension: 0.3
                                },
                                {
                                    label: 'Diet Done',
                                    data: {!! json_encode($records->pluck('diet_done')) !!},
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                    fill: true,
                                    tension: 0.3
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { 
                                    min: 0, 
                                    max: 5, 
                                    ticks: { stepSize: 1 }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: '#e5e7eb'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
        </div>
    @empty
        <p class="text-gray-700">No progress records found.</p>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-app-layout>
