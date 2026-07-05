<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() { return view('admin.products.index', ['products' => Product::with('category')->latest()->paginate(10)]); }
    public function create() { return view('admin.products.form', ['product' => new Product, 'categories' => Category::all()]); }
    public function store(Request $request) { Product::create($this->data($request)); return redirect()->route('admin.products.index')->with('success', 'Product saved.'); }
    public function show(Product $product) { return redirect()->route('products.show', $product); }
    public function edit(Product $product) { return view('admin.products.form', ['product' => $product, 'categories' => Category::all()]); }
    public function update(Request $request, Product $product) { $product->update($this->data($request)); return redirect()->route('admin.products.index')->with('success', 'Product updated.'); }
    public function destroy(Product $product) { $product->delete(); return back()->with('success', 'Product deleted.'); }

    private function data(Request $request): array
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_limit' => 'required|integer|min:0',
            'short_description' => 'nullable|max:500',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        return $data;
    }
}
