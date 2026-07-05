<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit() { return view('customer.profile.edit', ['user' => auth()->user()]); }
    public function update(Request $request) { auth()->user()->update($request->validate(['name' => 'required|max:255', 'phone' => 'nullable|max:30'])); return back()->with('success', 'Profile updated.'); }
}
