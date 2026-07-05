<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index() { return view('admin.customers.index', ['customers' => User::where('role', 'customer')->withCount('orders')->paginate(15)]); }
    public function show(User $user) { return view('admin.customers.show', ['customer' => $user->load('orders')]); }
}
