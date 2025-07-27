@extends('layouts.admin')

@section('title', 'All Diet Plans')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">All Diet Plans</h2>

    @if($diets->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($diets as $diet)
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="text-xl font-bold">{{ $diet->title }}</h3>
                    <p class="text-gray-600 mb-2">Goal: {{ $diet->goal }}</p>
                    <p class="text-sm text-gray-500 mb-2">Duration: {{ $diet->duration ?? 'N/A' }} days</p>
                    <a href="#" class="inline-block mt-2 text-blue-600 hover:underline">View Details</a>
                </div>
            @endforeach
        </div>
    @else
        <p>No diet plans found.</p>
    @endif
</div>
@endsection
