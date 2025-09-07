<div class="bg-gray-100 p-4 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-3 text-gray-800">What People Say</h2>

    <div class="overflow-hidden relative">
        <div class="flex space-x-9 animate-scroll">
            @foreach(\App\Models\Testimonial::latest()->take(6)->get() as $review)
                <div class="min-w-[250px] bg-white p-6 rounded-xl shadow">
                    <h3 class="font-semibold text-gray-900">{{ $review->name }}</h3>
                    <p class="text-yellow-500">
                        {{ str_repeat('⭐', $review->rating) }}
                        {{ str_repeat('☆', 5 - $review->rating) }}
                    </p>
                    <p class="text-gray-600 mt-2">{{ $review->message }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('testimonials.index') }}" class="text-blue-600 hover:underline">
            See more reviews →
        </a>
    </div>
</div>
