<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        if (auth()->check()) {
            return redirect(auth()->user()->role === 'admin' ? route('admin.dashboard') : route('home'));
        }
        return $next($request);
    }
}
