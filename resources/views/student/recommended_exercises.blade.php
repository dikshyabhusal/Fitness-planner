<x-app-layout>

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Recommended Exercises</h1>

    @if($exercises->isEmpty())
        <p>No exercises available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($exercises as $exercise)
                <div class="border rounded p-4 shadow">
                    <h3 class="font-semibold text-lg">{{ $exercise->title ?? $exercise->name }}</h3>
                    <p><strong>Category ID:</strong> {{ $exercise->exercise_category_id }}</p>
                    <p><strong>Coach Tips:</strong> {{ $exercise->coach_tips ?? 'N/A' }}</p>
                    <p><strong>Precautions:</strong> {{ $exercise->precautions ?? 'N/A' }}</p>
                    <p><strong>How to Start:</strong> {{ $exercise->how_to_start ?? 'N/A' }}</p>
                    @if($exercise->photo)
                        <img src="{{ $exercise->photo }}" alt="Exercise photo" class="mt-2 w-full h-32 object-cover">
                    @endif
                    @if($exercise->video)
                        <a href="{{ $exercise->video }}" target="_blank" class="text-blue-600 underline mt-2 block">Watch Video</a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-app-layout>
