@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Contact Messages</h2>

    @if($contacts->count())
        <div class="space-y-4">
            @foreach($contacts as $contact)
                <div class="bg-white rounded-xl shadow p-4">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $contact->name }}</h3>
                            <p class="text-gray-600">{{ $contact->email }}</p>
                            <p class="text-sm text-gray-500 mt-1">Subject: {{ $contact->subject }}</p>
                        </div>
                        <div class="text-sm text-gray-400">
                            {{ $contact->created_at->format('F j, Y') }}
                        </div>
                    </div>
                    <p class="mt-2 text-gray-700">{{ $contact->message }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No contact messages found.</p>
    @endif
</div>
@endsection
