<x-guest-layout>
    <div class="max-w-5xl mx-auto py-12 px-6 text-white">
        <h1 class="text-4xl font-bold mb-4">{{ $workout['title'] }}</h1>
        <p class="text-gray-300 mb-6 text-lg">{{ $workout['description'] }}</p>

        <div class="aspect-w-16 aspect-h-9">
            <iframe class="w-full h-96 rounded-lg shadow-lg"
                    src="{{ $workout['video'] }}"
                    frameborder="0"
                    allowfullscreen></iframe>
        </div>
    </div>
</x-guest-layout>
