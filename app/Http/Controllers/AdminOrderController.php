<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('student','items.product')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:Pending,Paid,Shipped,Delivered,Cancelled']);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated');
    }
    
}
