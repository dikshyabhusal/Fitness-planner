<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-purple-700 mb-4">
        🗓️ Workout Calendar - {{ now()->format('F Y') }}
    </h2>

    <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-700 mb-2">
        @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
            <div>{{ $day }}</div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-2 text-sm">
        @foreach($calendar as $week)
            @foreach($week as $day)
                <div class="border p-2 rounded h-20 {{ $day['date']->isToday() ? 'bg-purple-100' : 'bg-gray-50' }}">
                    <div class="font-bold text-xs">{{ $day['date']->day }}</div>
                    <div class="mt-2">
                        @if($day['date']->month != now()->month)
                            <span class="text-gray-300">—</span>
                        @elseif($day['workout_done'] === 1)
                            ✅
                        @elseif($day['workout_done'] === 0)
                            ❌
                        @endif
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
