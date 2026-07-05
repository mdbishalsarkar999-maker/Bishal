<div class="product-card">
    <img class="product-img" src="<?php echo e($product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80'); ?>" alt="<?php echo e($product->name); ?>">
    <div class="p-3">
        <div class="text-muted small"><?php echo e($product->category->name ?? 'General'); ?></div>
        <h5 class="mt-1"><a class="text-decoration-none text-dark" href="<?php echo e(route('products.show', $product)); ?>"><?php echo e($product->name); ?></a></h5>
        <div class="mb-2"><span class="price">৳<?php echo e(number_format($product->selling_price, 2)); ?></span> <?php if($product->discount_price): ?><span class="old-price ms-2">৳<?php echo e(number_format($product->price, 2)); ?></span><?php endif; ?></div>
        <div class="small text-warning mb-3">★ <?php echo e($product->average_rating ?: 'New'); ?></div>
        <?php if($product->stock_quantity > 0): ?>
            <form method="post" action="<?php echo e(route('cart.store')); ?>"><?php echo csrf_field(); ?><input type="hidden" name="product_id" value="<?php echo e($product->id); ?>"><button class="btn btn-primary w-100">Add to Cart</button></form>
        <?php else: ?>
            <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\LastMinuteProject\resources\views/customer/partials/product-card.blade.php ENDPATH**/ ?>