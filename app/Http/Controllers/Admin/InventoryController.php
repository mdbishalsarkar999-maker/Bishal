<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index() { return view('admin.inventory.index', ['products' => Product::with('stockLogs')->orderBy('stock_quantity')->paginate(15)]); }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['stock_quantity' => 'required|integer|min:0', 'note' => 'nullable|max:255']);
        $change = $data['stock_quantity'] - $product->stock_quantity;
        $product->update(['stock_quantity' => $data['stock_quantity']]);
        $product->stockLogs()->create(['user_id' => auth()->id(), 'quantity_change' => $change, 'stock_after' => $product->stock_quantity, 'note' => $data['note'] ?? 'Manual stock update']);
        return back()->with('success', 'Stock updated.');
    }
}
