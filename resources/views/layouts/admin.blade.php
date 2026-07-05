<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - LocalMart BD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-shell">
<aside class="admin-sidebar no-print">
    <h4 class="mb-4">LocalMart BD</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.categories.index') }}">Categories</a>
    <a href="{{ route('admin.products.index') }}">Products</a>
    <a href="{{ route('admin.inventory.index') }}">Inventory</a>
    <a href="{{ route('admin.orders.index') }}">Orders</a>
    <a href="{{ route('admin.payments.index') }}">Payments</a>
    <a href="{{ route('admin.customers.index') }}">Customers</a>
    <a href="{{ route('admin.coupons.index') }}">Coupons</a>
    <a href="{{ route('admin.reviews.index') }}">Reviews</a>
    <a href="{{ route('admin.reports.sales') }}">Sales Report</a>
    <a href="{{ route('home') }}">Customer Site</a>
</aside>
<main class="admin-main">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h2 class="m-0">@yield('title')</h2>
        <form method="post" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-secondary btn-sm">Logout</button></form>
    </div>
    @if(session('success'))<div class="alert alert-success no-print">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger no-print">{{ $errors->first() }}</div>@endif
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
