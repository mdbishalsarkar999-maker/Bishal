<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() { return view('admin.reviews.index', ['reviews' => Review::with('user', 'product')->latest()->paginate(15)]); }
    public function update(Request $request, Review $review) { $review->update($request->validate(['is_approved' => 'required|boolean'])); return back()->with('success', 'Review updated.'); }
    public function destroy(Review $review) { $review->delete(); return back()->with('success', 'Review deleted.'); }
}
