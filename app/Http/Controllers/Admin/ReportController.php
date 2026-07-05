<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $orders = Order::with('user')->where('status', '!=', 'cancelled')
            ->when($request->from, fn ($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->to, fn ($q) => $q->whereDate('created_at', '<=', $request->to))
            ->latest()->paginate(20)->withQueryString();
        return view('admin.reports.sales', ['orders' => $orders, 'total' => $orders->sum('total_amount')]);
    }
}
