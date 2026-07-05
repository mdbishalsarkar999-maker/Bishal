<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() { return view('admin.payments.index', ['payments' => Payment::with('order.user')->latest()->paginate(15)]); }
    public function update(Request $request, Payment $payment) { $payment->update($request->validate(['status' => 'required|in:pending,paid,failed'])); return back()->with('success', 'Payment updated.'); }
}
