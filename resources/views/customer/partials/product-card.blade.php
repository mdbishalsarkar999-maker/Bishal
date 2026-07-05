<div class="product-card">
    <img class="product-img" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $product->name }}">
    <div class="p-3">
        <div class="text-muted small">{{ $product->category->name ?? 'General' }}</div>
        <h5 class="mt-1"><a class="text-decoration-none text-dark" href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h5>
        <div class="mb-2"><span class="price">৳{{ number_format($product->selling_price, 2) }}</span> @if($product->discount_price)<span class="old-price ms-2">৳{{ number_format($product->price, 2) }}</span>@endif</div>
        <div class="small text-warning mb-3">★ {{ $product->average_rating ?: 'New' }}</div>
        @if($product->stock_quantity > 0)
            <form method="post" action="{{ route('cart.store') }}">@csrf<input type="hidden" name="product_id" value="{{ $product->id }}"><button class="btn btn-primary w-100">Add to Cart</button></form>
        @else
            <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
        @endif
    </div>
</div>
