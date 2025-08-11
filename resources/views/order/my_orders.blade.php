<x-app-layout>

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">My Orders</h1>

    @if($orders->isEmpty())
        <p class="text-gray-500 italic">You have no orders yet.</p>
    @else
        <table class="w-full border-collapse border border-purple-200 rounded-lg shadow-sm">
            <thead class="bg-purple-50">
                <tr>
                    <th class="p-3 text-left text-purple-600 font-semibold">Order ID</th>
                    <th class="p-3 text-left text-purple-600 font-semibold">Date</th>
                    <th class="p-3 text-left text-purple-600 font-semibold">Products</th> {{-- New column --}}
                    <th class="p-3 text-left text-purple-600 font-semibold">Total (Rs)</th>
                    <th class="p-3 text-left text-purple-600 font-semibold">Status</th>
                    <th class="p-3 text-left text-purple-600 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b border-purple-100 hover:bg-purple-50 transition">
                    <td class="p-3">{{ $order->id }}</td>
                    <td class="p-3">{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="p-3 max-w-xs">
                        {{-- List all product names separated by commas --}}
                        {{ $order->items->pluck('product.name')->filter()->join(', ') }}
                    </td>
                    <td class="p-3 font-semibold text-purple-700">{{ number_format($order->total_amount, 2) }}</td>
                    <td class="p-3">
                        <span
                            @class([
                                'px-2 py-1 rounded-full text-xs font-semibold',
                                'bg-yellow-100 text-yellow-700' => $order->status == 'Pending',
                                'bg-green-100 text-green-700' => $order->status == 'Paid',
                                'bg-blue-100 text-blue-700' => $order->status == 'Shipped',
                                'bg-purple-100 text-purple-700' => $order->status == 'Delivered',
                                'bg-red-100 text-red-700' => $order->status == 'Cancelled',
                            ])
                        >
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('orders.my.details', $order) }}" class="text-purple-600 hover:underline font-semibold">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
</x-app-layout>
