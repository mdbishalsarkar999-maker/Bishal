<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->firstOrCreate();
        return view('customer.cart.index', ['cart' => $cart->load('items.product')]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'nullable|integer|min:1']);
        $product = Product::findOrFail($data['product_id']);
        abort_if($product->stock_quantity < 1, 422, 'Out of stock');
        $cart = auth()->user()->cart()->firstOrCreate();
        $item = $cart->items()->firstOrNew(['product_id' => $product->id]);
        $item->quantity = min(($item->quantity ?: 0) + ($data['quantity'] ?? 1), $product->stock_quantity);
        $item->save();
        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, string $id)
    {
        $item = auth()->user()->cart->items()->whereKey($id)->firstOrFail();
        $data = $request->validate(['quantity' => 'required|integer|min:1']);
        $item->update(['quantity' => min($data['quantity'], $item->product->stock_quantity)]);
        return back()->with('success', 'Cart updated.');
    }

    public function destroy(string $id)
    {
        auth()->user()->cart->items()->whereKey($id)->delete();
        return back()->with('success', 'Item removed.');
    }
}
