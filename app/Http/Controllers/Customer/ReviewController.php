<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $delivered = auth()->user()->orders()->where('status', 'delivered')->whereHas('items', fn ($q) => $q->where('product_id', $product->id))->exists();
        abort_unless($delivered, 403, 'You can review after delivery.');
        $data = $request->validate(['rating' => 'required|integer|min:1|max:5', 'comment' => 'nullable|string|max:1000']);
        $product->reviews()->create($data + ['user_id' => auth()->id(), 'is_approved' => false]);
        return back()->with('success', 'Review submitted for approval.');
    }
}
