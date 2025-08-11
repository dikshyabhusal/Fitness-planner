<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 px-4">

        <!-- SHOP HEADER + View Orders Button -->
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-lg mb-8 border-l-8 border-purple-500">
            <h1 class="text-4xl font-extrabold text-purple-700 flex items-center gap-2">
                🛒 Shop
            </h1>
            <a href="{{ route('orders.my') }}" 
               class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                📦 View My Orders
            </a>
        </div>

        <!-- SUCCESS ALERT -->
        @if(session('success'))
            <div class="bg-purple-100 border border-purple-300 text-purple-800 p-4 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- PRODUCT GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="bg-white border rounded-2xl shadow-sm hover:shadow-lg transition p-4 flex flex-col max-w-sm mx-auto">
                    <!-- PRODUCT IMAGE -->
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="h-36 w-full object-cover rounded-xl mb-3">
                    @else
                        <div class="h-36 bg-gray-200 flex items-center justify-center rounded-xl mb-3 text-gray-500 text-sm font-semibold">
                            No Image
                        </div>
                    @endif

                    <!-- PRODUCT INFO -->
                    <h2 class="text-xl font-bold text-gray-800 mb-1 truncate">{{ $product->name }}</h2>
                    <p class="text-lg text-purple-700 font-semibold">Rs. {{ number_format($product->price, 2) }}</p>
                    <p class="text-xs text-gray-500 mb-3">Stock: {{ $product->stock }}</p>

                    <!-- ORDER FORM -->
                    <form action="{{ route('order.store') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity Selector -->
                        <label for="quantity-{{ $product->id }}" class="block mb-1 font-medium text-sm">Quantity</label>
                        <div class="flex items-center mb-4 max-w-[110px]">
                            <button type="button" onclick="changeQty('{{ $product->id }}', -1)"
                                    class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded-l transition text-lg font-bold">-</button>
                            <input type="number"
                                   name="quantity"
                                   id="quantity-{{ $product->id }}"
                                   value="1"
                                   min="1"
                                   max="{{ $product->stock }}"
                                   class="w-14 text-center border-t border-b border-gray-300 focus:outline-none"
                                   required>
                            <button type="button" onclick="changeQty('{{ $product->id }}', 1)"
                                    class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded-r transition text-lg font-bold">+</button>
                        </div>

                        <!-- Buy Now Button -->
                        <a href="{{ route('order.create', $product->id) }}"
                           class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition w-full inline-block text-center font-semibold">
                           🛍 Buy Now
                        </a>
                    </form>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500 italic">No products available right now.</p>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>

    <!-- JS for Quantity Control -->
    <script>
        function changeQty(id, delta) {
            const input = document.getElementById('quantity-' + id);
            let val = parseInt(input.value) || 1;
            val += delta;
            if(val < 1) val = 1;
            if(val > parseInt(input.max)) val = parseInt(input.max);
            input.value = val;
        }
    </script>
</x-app-layout>
