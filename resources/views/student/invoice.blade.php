@extends('layout.app')
@section('content')
<h2 class="text-xl font-bold">Invoice #{{ $order->id }}</h2>
<p>Status: {{ $order->status }}</p>
<table class="w-full border mt-4">
    <tr>
        <th>Product</th><th>Qty</th><th>Price</th><th>Total</th>
    </tr>
    @foreach($order->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rs {{ $item->price }}</td>
        <td>Rs {{ $item->price * $item->quantity }}</td>
    </tr>
    @endforeach
</table>
<p class="mt-4 font-bold">Grand Total: Rs {{ $order->total_amount }}</p>
@endsection
