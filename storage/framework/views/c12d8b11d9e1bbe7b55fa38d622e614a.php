<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'LocalMart BD'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">LocalMart BD</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <form class="d-flex ms-lg-4 my-3 my-lg-0 flex-grow-1" action="<?php echo e(route('products.index')); ?>">
                <input class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search local products">
                <button class="btn btn-primary ms-2">Search</button>
            </form>
            <ul class="navbar-nav ms-lg-3 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('products.index')); ?>">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('about')); ?>">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('cart.index')); ?>">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('wishlist.index')); ?>">Wishlist</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"><?php echo e(auth()->user()->name); ?></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <?php if(auth()->user()->role === 'admin'): ?><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">Admin Dashboard</a><?php endif; ?>
                            <a class="dropdown-item" href="<?php echo e(route('orders.index')); ?>">My Orders</a>
                            <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profile</a>
                            <form method="post" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="dropdown-item">Logout</button></form>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li class="nav-item"><a class="btn btn-success btn-sm" href="<?php echo e(route('register')); ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main>
    <?php if(session('success')): ?><div class="container mt-3"><div class="alert alert-success"><?php echo e(session('success')); ?></div></div><?php endif; ?>
    <?php if($errors->any()): ?><div class="container mt-3"><div class="alert alert-danger"><?php echo e($errors->first()); ?></div></div><?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
<footer class="border-top mt-5 py-4 bg-light"><div class="container d-flex flex-wrap justify-content-between"><span>LocalMart BD</span><span class="text-muted">Built for local retail businesses in Bangladesh</span></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\LastMinuteProject\resources\views/layouts/app.blade.php ENDPATH**/ ?>