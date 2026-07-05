<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() { return view('customer.orders.index', ['orders' => auth()->user()->orders()->latest()->paginate(10)]); }
    public function confirmation(Order $order) { $this->authorizeCustomer($order); return view('customer.orders.confirmation', compact('order')); }
    public function show(Order $order) { $this->authorizeCustomer($order); return view('customer.orders.show', ['order' => $order->load('items.product', 'payment', 'shippingAddress')]); }

    public function cancel(Order $order)
    {
        $this->authorizeCustomer($order);
        abort_unless(in_array($order->status, ['pending', 'confirmed', 'processing']), 422);
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled.');
    }

    private function authorizeCustomer(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
