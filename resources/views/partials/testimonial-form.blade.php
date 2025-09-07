<div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Leave a Review</h2>

    @if(session('success'))
        <p class="text-green-600 mb-3">{{ session('success') }}</p>
    @endif

    <form action="{{ route('testimonials.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name"
               class="w-full p-2 border rounded-lg mb-3" required>

        <textarea name="message" placeholder="Your Review"
                  class="w-full p-2 border rounded-lg mb-3" required></textarea>

        <label class="block mb-2">Rating</label>
        <select name="rating" class="w-full p-2 border rounded-lg mb-3" required>
            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
            <option value="4">⭐⭐⭐⭐ (4)</option>
            <option value="3">⭐⭐⭐ (3)</option>
            <option value="2">⭐⭐ (2)</option>
            <option value="1">⭐ (1)</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Submit Review
        </button>
    </form>
</div>
