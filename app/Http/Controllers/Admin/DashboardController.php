<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalSales' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'lowStockProducts' => Product::whereColumn('stock_quantity', '<=', 'low_stock_limit')->count(),
            'salesByMonth' => Order::selectRaw('MONTH(created_at) month, SUM(total_amount) total')->groupBy('month')->pluck('total', 'month'),
            'topProducts' => OrderItem::selectRaw('product_name, SUM(quantity) as sold_quantity')
                ->groupBy('product_name')
                ->orderByDesc('sold_quantity')
                ->take(5)
                ->get(),
        ]);
    }
}
