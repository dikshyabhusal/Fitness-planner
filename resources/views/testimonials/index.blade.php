<div class="bg-gray-100 p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">All Reviews</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach(\App\Models\Testimonial::latest()->take(6)->get() as $review)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-900">{{ $review->name }}</h3>
                <p class="text-yellow-500 mt-1">
                    {{ str_repeat('⭐', $review->rating) }}
                    {{ str_repeat('☆', 5 - $review->rating) }}
                </p>
                <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                    {{ $review->message }}
                </p>
            </div>
        @endforeach
    </div>
</div>
