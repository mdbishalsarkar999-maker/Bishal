<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index() { return view('customer.wishlist.index', ['items' => Wishlist::with('product')->where('user_id', auth()->id())->get()]); }
    public function store(Request $request) { Wishlist::firstOrCreate(['user_id' => auth()->id(), 'product_id' => $request->validate(['product_id' => 'required|exists:products,id'])['product_id']]); return back()->with('success', 'Added to wishlist.'); }
    public function destroy(string $id) { Wishlist::where('user_id', auth()->id())->whereKey($id)->delete(); return back()->with('success', 'Removed from wishlist.'); }
}
