<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() { return view('admin.orders.index', ['orders' => Order::with('user', 'payment')->latest()->paginate(15)]); }
    public function show(Order $order) { return view('admin.orders.show', ['order' => $order->load('user', 'items', 'payment', 'shippingAddress')]); }
    public function invoice(Order $order) { return view('admin.orders.invoice', ['order' => $order->load('user', 'items', 'payment', 'shippingAddress')]); }
    public function updateStatus(Request $request, Order $order) { $order->update($request->validate(['status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'])); return back()->with('success', 'Order status updated.'); }
}
