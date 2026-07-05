<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LocalMart BD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">LocalMart BD</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <form class="d-flex ms-lg-4 my-3 my-lg-0 flex-grow-1" action="{{ route('products.index') }}">
                <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search local products">
                <button class="btn btn-primary ms-2">Search</button>
            </form>
            <ul class="navbar-nav ms-lg-3 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ auth()->user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->role === 'admin')<a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>@endif
                            <a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <form method="post" action="{{ route('logout') }}">@csrf<button class="dropdown-item">Logout</button></form>
                        </div>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-success btn-sm" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main>
    @if(session('success'))<div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>@endif
    @if($errors->any())<div class="container mt-3"><div class="alert alert-danger">{{ $errors->first() }}</div></div>@endif
    @yield('content')
</main>
<footer class="border-top mt-5 py-4 bg-light"><div class="container d-flex flex-wrap justify-content-between"><span>LocalMart BD</span><span class="text-muted">Built for local retail businesses in Bangladesh</span></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
