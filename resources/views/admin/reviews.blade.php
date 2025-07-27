@extends('layouts.admin')

@section('title', 'All Reviews')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">All Reviews</h2>

    @if($reviews->count())
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-xl shadow p-4">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-lg font-bold">
                                {{ $review->student->name ?? 'Unknown Student' }} 
                                on 
                                {{ $review->workoutPlan->title ?? 'Unknown Plan' }}
                            </h3>
                            <p class="text-gray-600">Trainer: {{ $review->trainer->name ?? 'N/A' }}</p>
                        </div>
                        <div class="text-yellow-500 font-bold">
                            ⭐ {{ $review->rating }}/5
                        </div>
                    </div>
                    <p class="mt-2 text-gray-700 italic">"{{ $review->comment }}"</p>
                    <p class="text-sm text-gray-400 mt-1">Reviewed on {{ $review->created_at->format('F j, Y') }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No reviews found.</p>
    @endif
</div>
@endsection
