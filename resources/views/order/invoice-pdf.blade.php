<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { padding:8px; border:1px solid #ddd; text-align:left; }
        .right { text-align:right; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $order->id }}</h2>
    <p>Date: {{ $order->created_at->format('Y-m-d H:i') }}</p>
    <p>Buyer: {{ $order->student?->name ?? 'Student' }}</p>

    <table>
        <thead>
            <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="right">Rs {{ number_format($item->price,2) }}</td>
                <td class="right">Rs {{ number_format($item->price * $item->quantity,2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="right"><strong>Grand Total</strong></td>
                <td class="right"><strong>Rs {{ number_format($order->total_amount,2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
