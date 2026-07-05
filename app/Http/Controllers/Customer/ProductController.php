<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category', 'reviews')->where('is_active', true)
            ->when($request->search, fn ($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->when($request->category, fn ($q, $category) => $q->whereHas('category', fn ($c) => $c->where('slug', $category)))
            ->when($request->min_price, fn ($q, $price) => $q->where('price', '>=', $price))
            ->when($request->max_price, fn ($q, $price) => $q->where('price', '<=', $price))
            ->latest()->paginate(12)->withQueryString();

        return view('customer.products.index', [
            'products' => $products,
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);
        return view('customer.products.show', [
            'product' => $product->load('category', 'reviews.user'),
            'relatedProducts' => Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get(),
        ]);
    }
}
