<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('customer.home', [
            'categories' => Category::where('is_active', true)->withCount('products')->get(),
            'featuredProducts' => Product::with('category')->where('is_active', true)->latest()->take(4)->get(),
            'latestProducts' => Product::with('category')->where('is_active', true)->latest()->take(8)->get(),
        ]);
    }
}
