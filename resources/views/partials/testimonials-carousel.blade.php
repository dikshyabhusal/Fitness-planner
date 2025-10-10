<div class="bg-gray-100 p-6 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-5 text-gray-800 text-center">What People Say</h2>

    <!-- Slider container -->
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach(\App\Models\Testimonial::latest()->take(12)->get() as $review)
                <div class="swiper-slide bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-gray-900">{{ $review->name }}</h3>
                    <p class="text-yellow-500 text-lg">
                        {{ str_repeat('⭐', $review->rating) }}
                        {{ str_repeat('☆', 5 - $review->rating) }}
                    </p>
                    <p class="text-gray-600 mt-2 line-clamp-3">{{ $review->message }}</p>
                </div>
            @endforeach
        </div>

        <!-- Navigation arrows -->
        <div class="flex justify-between items-center mt-4">
            <div class="swiper-button-prev text-gray-700"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next text-gray-700"></div>
        </div>
    </div>

    {{-- <div class="mt-6 text-center">
        <a href="{{ route('testimonials.index') }}" 
           class="text-blue-600 font-medium hover:underline">
            See more reviews →
        </a>
    </div> --}}
</div>

<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".swiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 },
            }
        });
    });
</script>
