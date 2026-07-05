<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin - LocalMart BD'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body class="admin-shell">
<aside class="admin-sidebar no-print">
    <h4 class="mb-4">LocalMart BD</h4>
    <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
    <a href="<?php echo e(route('admin.categories.index')); ?>">Categories</a>
    <a href="<?php echo e(route('admin.products.index')); ?>">Products</a>
    <a href="<?php echo e(route('admin.inventory.index')); ?>">Inventory</a>
    <a href="<?php echo e(route('admin.orders.index')); ?>">Orders</a>
    <a href="<?php echo e(route('admin.payments.index')); ?>">Payments</a>
    <a href="<?php echo e(route('admin.customers.index')); ?>">Customers</a>
    <a href="<?php echo e(route('admin.coupons.index')); ?>">Coupons</a>
    <a href="<?php echo e(route('admin.reviews.index')); ?>">Reviews</a>
    <a href="<?php echo e(route('admin.reports.sales')); ?>">Sales Report</a>
    <a href="<?php echo e(route('home')); ?>">Customer Site</a>
</aside>
<main class="admin-main">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h2 class="m-0"><?php echo $__env->yieldContent('title'); ?></h2>
        <form method="post" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="btn btn-outline-secondary btn-sm">Logout</button></form>
    </div>
    <?php if(session('success')): ?><div class="alert alert-success no-print"><?php echo e(session('success')); ?></div><?php endif; ?>
    <?php if($errors->any()): ?><div class="alert alert-danger no-print"><?php echo e($errors->first()); ?></div><?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\LastMinuteProject\resources\views/layouts/admin.blade.php ENDPATH**/ ?>