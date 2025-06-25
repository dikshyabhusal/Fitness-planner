<x-app-layout>


<div class="min-h-screen bg-gradient-to-br from-[#1a1a2e] via-[#16213e] to-[#0f3460] flex items-center justify-center py-12 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-2xl border border-purple-300">
        <h2 class="text-4xl font-bold text-purple-600 mb-6 text-center">Contact Us</h2>
        <p class="text-gray-600 mb-8 text-center">Have a question or feedback? Let’s connect.</p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Subject</label>
                <input type="text" name="subject" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Message</label>
                <textarea name="message" rows="4" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required></textarea>
            </div>

            <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-purple-800 transition font-semibold">
                Send Message
            </button>
        </form>
    </div>
</div>


</x-app-layout>
