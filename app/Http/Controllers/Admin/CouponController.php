<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() { return view('admin.coupons.index', ['coupons' => Coupon::latest()->paginate(10)]); }
    public function create() { return view('admin.coupons.form', ['coupon' => new Coupon]); }
    public function store(Request $request) { Coupon::create($this->data($request)); return redirect()->route('admin.coupons.index')->with('success', 'Coupon saved.'); }
    public function edit(Coupon $coupon) { return view('admin.coupons.form', compact('coupon')); }
    public function update(Request $request, Coupon $coupon) { $coupon->update($this->data($request)); return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated.'); }
    public function destroy(Coupon $coupon) { $coupon->delete(); return back()->with('success', 'Coupon deleted.'); }
    private function data(Request $request): array { $data = $request->validate(['code' => 'required|max:50', 'discount_type' => 'required|in:percentage,fixed', 'discount_value' => 'required|numeric|min:0', 'expires_at' => 'required|date', 'is_active' => 'nullable|boolean']); $data['is_active'] = $request->boolean('is_active'); return $data; }
}
