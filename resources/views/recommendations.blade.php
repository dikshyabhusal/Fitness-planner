<x-app-layout>
<pre>{{ $output }}</pre>

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">💪 Workout Recommendations</h1>

    @php
        $data = json_decode($output, true);
    @endphp

    @if($data)
    {{-- Student Info Card --}}
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border-l-4 border-blue-500">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">👤 Student Info</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">Age:</p>
                <p class="text-gray-800">{{ $data['student']['age'] }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">Gender:</p>
                <p class="text-gray-800">{{ ucfirst($data['student']['gender']) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">Height:</p>
                <p class="text-gray-800">{{ $data['student']['height'] }} cm</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">Weight:</p>
                <p class="text-gray-800">{{ $data['student']['weight'] }} kg</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">BMI:</p>
                <p class="text-gray-800">{{ $data['student']['bmi'] }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                <p class="font-medium text-gray-600">BMI Category:</p>
                <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                    {{ $data['bmi_category'] }}
                </span>
            </div>
        </div>
    </div>

    {{-- Recommended Workouts --}}
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-500">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">🏋️ Recommended Workouts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($data['recommendations'] as $rec)
                <div class="bg-green-50 p-4 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <p class="font-medium text-green-700">{{ $rec }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @else
        <p class="text-red-500 font-semibold text-center">No recommendations found.</p>
    @endif

    <div class="text-center mt-6">
        <a href="{{ url()->previous() }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
           🔙 Go Back
        </a>
    </div>
</div>
@endsection

</x-app-layout>
