@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-6">

    <h1 class="text-4xl font-extrabold text-purple-700 mb-8">Manage Orders</h1>

    @if(session('success'))
        <div class="bg-purple-100 border border-purple-300 text-purple-700 p-4 rounded-lg mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-purple-200">
        <table class="min-w-full divide-y divide-purple-200">
            <thead class="bg-purple-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Order ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Student</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Delivery Address</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Items</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Total (Rs)</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-100">
                @forelse ($orders as $order)
                <tr class="hover:bg-purple-50 transition duration-150">
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $order->id }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $order->student->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-purple-700 font-semibold">
                        <a href="mailto:{{ $order->student->email ?? '' }}" class="hover:underline">
                            {{ $order->student->email ?? 'N/A' }}
                        </a>
                    </td>
                    <td class="px-4 py-3 max-w-xs text-sm text-gray-700 truncate" title="{{ $order->delivery_address ?? 'N/A' }}">
                        {{ $order->delivery_address ?? 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-800 max-w-xs">
                        <ul class="list-disc list-inside space-y-0.5 max-h-24 overflow-y-auto">
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name ?? 'N/A' }} <span class="text-gray-500">(x{{ $item->quantity }})</span></li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-purple-700">{{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold">
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
                    <td class="px-4 py-3 whitespace-nowrap space-x-2 text-sm">
                        <!-- Status Update Form -->
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline-flex items-center space-x-2">
                            @csrf
                            <select name="status" class="border border-purple-300 rounded px-2 py-1 text-xs focus:ring-1 focus:ring-purple-400 focus:outline-none">
                                @foreach(['Pending','Paid','Shipped','Delivered','Cancelled'] as $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-3 py-1 rounded hover:scale-105 transition text-xs font-semibold">
                                Update
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-6 text-center text-gray-400 italic">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>

</div>
@endsection
