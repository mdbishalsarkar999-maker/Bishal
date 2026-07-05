<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() { return view('admin.categories.index', ['categories' => Category::latest()->paginate(10)]); }
    public function create() { return view('admin.categories.form', ['category' => new Category]); }
    public function store(Request $request) { Category::create($this->data($request)); return redirect()->route('admin.categories.index')->with('success', 'Category saved.'); }
    public function edit(Category $category) { return view('admin.categories.form', compact('category')); }
    public function update(Request $request, Category $category) { $category->update($this->data($request)); return redirect()->route('admin.categories.index')->with('success', 'Category updated.'); }
    public function destroy(Category $category) { $category->delete(); return back()->with('success', 'Category deleted.'); }
    private function data(Request $request): array { $data = $request->validate(['name' => 'required|max:255', 'description' => 'nullable', 'is_active' => 'nullable|boolean']); $data['slug'] = Str::slug($data['name']); $data['is_active'] = $request->boolean('is_active'); return $data; }
}
