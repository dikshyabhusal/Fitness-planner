@extends('layouts.admin') {{-- Use your actual admin layout --}}

@section('title', 'All Workout Plans')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">All Workout Plans</h2>

    @if($workouts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($workouts as $workout)
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-xl font-bold">{{ $workout->title }}</h3>
                    <p class="text-gray-600 mb-2">Duration: {{ $workout->duration }} days</p>
                    <p class="text-sm text-gray-500 mb-2">Goal: {{ $workout->goal }}</p>
                    <a href="{{ route('admin.workouts', $workout->id) }}" 
                       class="inline-block mt-2 text-blue-600 hover:underline">View Details</a>
                </div>
            @endforeach
        </div>
    @else
        <p>No workout plans found.</p>
    @endif
</div>
@endsection
