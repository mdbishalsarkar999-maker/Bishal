<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = auth()->user()->cart()->with('items.product')->firstOrCreate();
        return view('customer.checkout.create', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'email' => 'nullable|email',
            'delivery_area' => 'required|in:inside_dhaka,outside_dhaka,same_district',
            'district' => 'required|max:100',
            'city' => 'required|max:100',
            'address_line' => 'required|max:500',
            'payment_method' => 'required|in:cash_on_delivery,bkash,nagad,card',
            'transaction_id' => 'nullable|required_if:payment_method,bkash,nagad|max:100',
            'coupon_code' => 'nullable|string',
        ]);

        $cart = auth()->user()->cart()->with('items.product')->firstOrFail();
        abort_if($cart->items->isEmpty(), 422, 'Your cart is empty.');

        return DB::transaction(function () use ($cart, $data) {
            $subtotal = 0;
            foreach ($cart->items as $item) {
                abort_if($item->quantity > $item->product->stock_quantity, 422, "{$item->product->name} has insufficient stock.");
                $subtotal += $item->quantity * $item->product->selling_price;
            }

            $delivery = ['inside_dhaka' => 80, 'outside_dhaka' => 130, 'same_district' => 50][$data['delivery_area']];
            $coupon = !empty($data['coupon_code']) ? Coupon::where('code', $data['coupon_code'])->first() : null;
            $discount = $coupon && $coupon->isValid()
                ? ($coupon->discount_type === 'percentage' ? ($subtotal * $coupon->discount_value / 100) : $coupon->discount_value)
                : 0;

            $order = Order::create([
                'user_id' => auth()->id(),
                'coupon_id' => $coupon?->id,
                'order_number' => 'LBD-'.now()->format('YmdHis').random_int(100, 999),
                'subtotal' => $subtotal,
                'delivery_charge' => $delivery,
                'discount_amount' => min($discount, $subtotal),
                'total_amount' => $subtotal + $delivery - min($discount, $subtotal),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'unit_price' => $item->product->selling_price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->quantity * $item->product->selling_price,
                ]);
                $item->product->decrement('stock_quantity', $item->quantity);
                $item->product->stockLogs()->create(['user_id' => auth()->id(), 'quantity_change' => -$item->quantity, 'stock_after' => $item->product->fresh()->stock_quantity, 'note' => 'Order placed']);
            }

            $order->shippingAddress()->create($data);
            $order->payment()->create(['method' => $data['payment_method'], 'transaction_id' => $data['transaction_id'] ?? null, 'status' => $data['payment_method'] === 'cash_on_delivery' ? 'pending' : 'paid']);
            $cart->items()->delete();

            return redirect()->route('orders.confirmation', $order)->with('success', 'Order placed successfully.');
        });
    }
}
