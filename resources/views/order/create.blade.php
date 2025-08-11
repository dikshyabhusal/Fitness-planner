<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg border-l-8 border-purple-500">
        <h1 class="text-3xl font-bold mb-6 text-purple-700">Confirm Your Order</h1>

        <form action="{{ route('order.store') }}" method="POST" id="orderForm">
            @csrf

            <!-- Product Info -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-1">{{ $product->name }}</h2>
                <p class="text-purple-700 font-bold">Price: Rs. {{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500 mb-2">Stock Available: {{ $product->stock }}</p>
            </div>

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- User Info (readonly) -->
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Name</label>
                <input type="text" id="name" value="{{ $user->name }}" readonly
                    class="w-full px-4 py-2 border rounded focus:outline-none bg-gray-100" />
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium mb-1">Email</label>
                <input type="email" id="email" value="{{ $user->email }}" readonly
                    class="w-full px-4 py-2 border rounded focus:outline-none bg-gray-100" />
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block font-medium mb-1">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                    class="w-24 px-4 py-2 border rounded focus:outline-none" required>
            </div>

            <!-- Delivery Address -->
            <div class="mb-6">
                <label for="delivery_address" class="block font-medium mb-1">Delivery Address</label>
                <input type="text" name="delivery_address" id="delivery_address" placeholder="Enter your delivery address"
                    class="w-full px-4 py-2 border rounded focus:outline-none" required>
            </div>

            <!-- Map for selecting location -->
            <div id="map" class="mb-6 rounded shadow border" style="height: 300px;"></div>

            <input type="hidden" name="latitude" id="latitude" required>
            <input type="hidden" name="longitude" id="longitude" required>

            <button type="submit"
                class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-6 py-3 rounded-lg shadow hover:scale-105 transition w-full">
                Confirm Order
            </button>
        </form>
    </div>

    <!-- Include Leaflet CSS & JS (for map) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Initialize map centered roughly (change to your country coords)
        const map = L.map('map').setView([27.7, 85.3], 10); // Kathmandu area example

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        function onMapClick(e) {
            const { lat, lng } = e.latlng;

            // Update hidden inputs
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Add or move marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        }

        map.on('click', onMapClick);
    </script>
</x-app-layout>
