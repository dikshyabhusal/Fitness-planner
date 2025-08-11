<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 px-4">

        <div class="bg-white p-6 rounded-2xl shadow-lg mb-6 border-l-8 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Invoice #{{ $order->id }}</h1>
                    <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p class="text-sm text-gray-500">Buyer: {{ $order->student?->name ?? 'Student' }}</p>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-lg text-gray-800">Grand Total</p>
                    <p class="text-2xl font-extrabold text-purple-700">Rs {{ number_format($order->total_amount,2) }}</p>

                    @if($order->status === 'Pending')
                        <button id="payNowBtn" class="mt-3 inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white px-4 py-2 rounded-lg shadow">
                            💳 Pay Now
                        </button>
                    @endif

                    <!-- download link (optional) -->
                    @if(class_exists(\Barryvdh\DomPDF\Facade\Pdf::class))
                        <a href="{{ route('order.invoice.download', $order->id) }}" class="mt-2 inline-block text-sm text-gray-600 hover:underline">Download PDF</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Progress -->
        <div class="bg-white p-6 rounded-2xl shadow mb-6">
            <h3 class="font-semibold text-gray-700 mb-4">Order Status</h3>

            @php
                $steps = ['Pending','Paid','Shipped','Delivered'];
                $current = $order->status;
            @endphp

            <div class="flex items-center space-x-4">
                @foreach($steps as $step)
                    @php
                        $active = array_search($step, $steps) <= array_search($current, $steps);
                    @endphp

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2
                            {{ $active ? 'bg-purple-600 text-white border-purple-600' : 'bg-white text-gray-400 border-gray-300' }}">
                            @if($active) ✓ @else {{ substr($step,0,1) }} @endif
                        </div>
                        <div class="text-sm {{ $active ? 'text-gray-800 font-semibold' : 'text-gray-400' }}">{{ $step }}</div>
                    </div>

                    @if(!$loop->last)
                        <div class="flex-1 h-0.5 bg-gray-200"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Items table -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-gray-700 mb-4">Items</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-sm text-gray-500">
                            <th class="py-2">Product</th>
                            <th class="py-2">Qty</th>
                            <th class="py-2">Unit Price</th>
                            <th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($order->items as $item)
                        <tr class="border-t">
                            <td class="py-3">{{ $item->product->name }}</td>
                            <td class="py-3">{{ $item->quantity }}</td>
                            <td class="py-3">Rs {{ number_format($item->price,2) }}</td>
                            <td class="py-3 text-right">Rs {{ number_format($item->price * $item->quantity,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>

@if($order->latitude && $order->longitude)
    <p><strong>Delivery Location:</strong> Latitude: {{ $order->latitude }}, Longitude: {{ $order->longitude }}</p>
@endif

            </div>

            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Payment method: <strong>{{ $order->payment_method ?? 'Not paid' }}</strong>
                    @if($order->payment_at) · Paid at: {{ $order->payment_at->format('Y-m-d H:i') }} @endif
                </div>

                <div class="text-lg font-bold">
                    Grand Total: Rs {{ number_format($order->total_amount,2) }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payBtn = document.getElementById('payNowBtn');
            if (!payBtn) return;

            payBtn.addEventListener('click', async function () {
                if (!confirm('Proceed to pay Rs {{ number_format($order->total_amount,2) }}?')) return;

                // fetch CSRF token from meta tag (layout should include it)
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const res = await fetch("{{ route('order.pay', $order->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ payment_method: 'Manual' })
                });

                const json = await res.json();

                if (res.ok && json.success) {
                    alert('Payment successful!');
                    // reload to reflect status change
                    window.location.reload();
                } else {
                    alert(json.error || 'Payment failed');
                }
            });
        });
    </script>
</x-app-layout>
