<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
<?php $__currentLoopData = ['Total Sales'=>'৳'.number_format($totalSales,2),'Total Orders'=>$totalOrders,'Total Products'=>$totalProducts,'Pending Orders'=>$pendingOrders,'Total Customers'=>$totalCustomers,'Low Stock Products'=>$lowStockProducts]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-4 col-xl-2"><div class="stat-card"><div class="text-muted small"><?php echo e($label); ?></div><h3><?php echo e($value); ?></h3></div></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row g-4"><div class="col-lg-8"><div class="table-card"><h5>Sales Chart</h5><canvas id="salesChart" height="110"></canvas></div></div><div class="col-lg-4"><div class="table-card"><h5>Top-selling Products</h5><?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="d-flex justify-content-between border-bottom py-2"><span><?php echo e($product->product_name); ?></span><span><?php echo e($product->sold_quantity); ?> sold</span></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div></div>
<?php $__env->startPush('scripts'); ?><script>new Chart(document.getElementById('salesChart'),{type:'line',data:{labels:<?php echo json_encode($salesByMonth->keys(), 15, 512) ?>,datasets:[{label:'Sales',data:<?php echo json_encode($salesByMonth->values(), 15, 512) ?>,borderColor:'#1769aa',backgroundColor:'rgba(34,160,107,.15)',fill:true}]}});</script><?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LastMinuteProject\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>