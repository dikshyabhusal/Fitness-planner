<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Recommended Plans</h1>

        @if(count($recommendations) == 0)
            <p>No recommendations found for your selection.</p>
        @else
            <ul class="space-y-2">
                @foreach($recommendations as $plan)
                    <li class="p-3 border rounded bg-gray-50">
                        <strong>{{ $plan['title'] }}</strong>
                        <span class="text-gray-600">({{ $plan['goal'] }} - {{ $plan['area'] }})</span>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('recommendation.form') }}" class="mt-4 inline-block text-blue-500">Go Back</a>
    </div>
</x-app-layout>
