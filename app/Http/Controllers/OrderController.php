<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Store order and order item(s)
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
             'delivery_address' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = (int) $request->quantity;

        if ($product->stock < $qty) {
            return back()->withErrors(['quantity' => 'Not enough stock available.']);
        }

        DB::beginTransaction();
        try {
            $total = $product->price * $qty;

            $order = Order::create([
                'student_id'   => Auth::id(),
                'total_amount' => $total,
                'status'       => 'Pending',
                'delivery_address' => $request->delivery_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'payment_method' => null, // or fill based on your flow
            'payment_at' => null,
            ]);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $qty,
                'price'      => $product->price, // unit price
            ]);

            $product->decrement('stock', $qty);

            DB::commit();

            // Redirect to invoice/details page
            return redirect()->route('order.invoice', $order->id)
                             ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to place order. Please try again.']);
        }
    }

    // Show invoice / order detail page
    public function invoice(Order $order)
    {
        // ownership check: student who ordered or admin can view
        $user = Auth::user();
        if ($user->role !== 'admin' && $order->student_id !== $user->id) {
            abort(403);
        }

        $order->load('items.product', 'student');

        return view('order.invoice', compact('order'));
    }

    // Simulate payment: mark as Paid
    public function pay(Request $request, Order $order)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $order->student_id !== $user->id) {
            abort(403);
        }

        if ($order->status !== 'Pending') {
            return response()->json(['error' => 'Order already paid or processed.'], 422);
        }

        $order->update([
            'status' => 'Paid',
            'payment_method' => $request->payment_method ?? 'Manual',
            'payment_at' => now(),
        ]);

        return response()->json(['success' => true, 'status' => $order->status]);
    }

    // Optional: download invoice as PDF (requires barryvdh/laravel-dompdf)
    public function downloadInvoice(Order $order)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $order->student_id !== $user->id) {
            abort(403);
        }

        $order->load('items.product','student');

        if (! class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            return back()->withErrors(['error' => 'PDF generator not installed.']);
        }

        $pdf = Pdf::loadView('order.invoice-pdf', compact('order'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('invoice_'.$order->id.'.pdf');
    }
    public function create(Product $product)
{
    $user = auth()->user();

    return view('order.create', compact('product', 'user'));
}
public function myOrders()
{
    $orders = auth()->user()->orders()->with('items.product')->latest()->paginate(10);
    return view('order.my_orders', compact('orders'));
}

public function myOrderDetails(Order $order)
{
    // Authorization: ensure student owns this order
    if ($order->student_id !== auth()->id()) {
        abort(403, 'Unauthorized access');
    }

    $order->load('items.product', 'student');
    return view('order.my_order_details', compact('order'));
}

}
