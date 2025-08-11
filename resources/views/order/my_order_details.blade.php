<x-app-layout>

<div class="max-w-4xl mx-auto mt-10 px-6 py-8 bg-white rounded-xl shadow-lg border border-purple-300">

    <a href="{{ route('orders.my') }}" 
       class="inline-block mb-6 text-purple-600 hover:text-purple-800 font-semibold transition">
        &larr; Back to My Orders
    </a>

    <h2 class="text-3xl font-extrabold mb-6 text-purple-700 border-b border-purple-300 pb-2">
        Order #{{ $order->id }} Details
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-gray-700">
        <div>
            <h3 class="text-purple-600 font-semibold mb-1">Status</h3>
            <p class="text-lg font-medium">{{ $order->status }}</p>
        </div>
        <div>
            <h3 class="text-purple-600 font-semibold mb-1">Order Date</h3>
            <p>{{ $order->created_at->format('Y-m-d H:i') }}</p>
        </div>

        {{-- Conditionally show Shipped or Delivered Date --}}
        @if(in_array($order->status, ['Shipped', 'Delivered']))
        <div>
            <h3 class="text-purple-600 font-semibold mb-1">
                {{ $order->status === 'Delivered' ? 'Delivered Date' : 'Shipped Date' }}
            </h3>
            <p>{{ $order->updated_at->format('Y-m-d H:i') }}</p>
        </div>
        @endif

        <div>
            <h3 class="text-purple-600 font-semibold mb-1">Delivery Address</h3>
            <p class="break-words">{{ $order->delivery_address ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Delivery Status Progress Bar -->
    <div class="mb-10">
        <h3 class="text-purple-700 font-semibold mb-4 text-lg">Delivery Status</h3>
        <div id="status-bar" class="flex justify-between items-center relative px-2">
            @php
                $statuses = ['Pending', 'Paid', 'Shipped', 'Delivered'];
                $currentStatus = $order->status;
            @endphp

            @foreach ($statuses as $index => $status)
                <div class="flex-1 text-center relative">
                    <div class="mx-auto mb-3 w-10 h-10 rounded-full border-4 border-gray-300 flex items-center justify-center font-bold text-gray-400"
                        data-status="{{ $status }}">
                        {{ $index + 1 }}
                    </div>
                    <div class="text-sm font-medium text-gray-600">{{ $status }}</div>

                    @if($index !== count($statuses) - 1)
                        <div class="absolute top-5 right-0 w-full h-1 bg-gray-300 -z-10" style="transform: translateX(50%) translateY(-50%);"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Order Items Table -->
    <table class="w-full border-collapse border border-purple-300 rounded-lg shadow-sm overflow-hidden">
        <thead class="bg-purple-100">
            <tr>
                <th class="p-4 text-left text-purple-700 font-semibold">Product</th>
                <th class="p-4 text-left text-purple-700 font-semibold">Quantity</th>
                <th class="p-4 text-left text-purple-700 font-semibold">Price (Rs)</th>
                <th class="p-4 text-left text-purple-700 font-semibold">Total (Rs)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr class="border-t border-purple-200 hover:bg-purple-50 transition">
                <td class="p-4">{{ $item->product->name ?? 'N/A' }}</td>
                <td class="p-4">{{ $item->quantity }}</td>
                <td class="p-4">Rs {{ number_format($item->price, 2) }}</td>
                <td class="p-4 font-semibold text-purple-700">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-6 text-right text-2xl font-extrabold text-purple-800">Grand Total: Rs {{ number_format($order->total_amount, 2) }}</p>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentStatus = @json($currentStatus);
        const statuses = Array.from(document.querySelectorAll('#status-bar div[data-status]'));

        let currentIndex = statuses.findIndex(el => el.dataset.status === currentStatus);

        statuses.forEach((el, i) => {
            if(i <= currentIndex) {
                el.classList.remove('border-gray-300', 'text-gray-400');
                el.classList.add('border-purple-600', 'text-purple-600');
            }
            if(i < currentIndex){
                const bar = el.nextElementSibling;
                if(bar && bar.classList.contains('absolute')){
                    bar.classList.remove('bg-gray-300');
                    bar.classList.add('bg-purple-600');
                }
            }
        });
    });
</script>

</x-app-layout>
