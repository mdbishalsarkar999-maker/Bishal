@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="row g-3 mb-4">
@foreach(['Total Sales'=>'৳'.number_format($totalSales,2),'Total Orders'=>$totalOrders,'Total Products'=>$totalProducts,'Pending Orders'=>$pendingOrders,'Total Customers'=>$totalCustomers,'Low Stock Products'=>$lowStockProducts] as $label=>$value)
<div class="col-md-4 col-xl-2"><div class="stat-card"><div class="text-muted small">{{ $label }}</div><h3>{{ $value }}</h3></div></div>
@endforeach
</div>
<div class="row g-4"><div class="col-lg-8"><div class="table-card"><h5>Sales Chart</h5><canvas id="salesChart" height="110"></canvas></div></div><div class="col-lg-4"><div class="table-card"><h5>Top-selling Products</h5>@foreach($topProducts as $product)<div class="d-flex justify-content-between border-bottom py-2"><span>{{ $product->product_name }}</span><span>{{ $product->sold_quantity }} sold</span></div>@endforeach</div></div></div>
@push('scripts')<script>new Chart(document.getElementById('salesChart'),{type:'line',data:{labels:@json($salesByMonth->keys()),datasets:[{label:'Sales',data:@json($salesByMonth->values()),borderColor:'#1769aa',backgroundColor:'rgba(34,160,107,.15)',fill:true}]}});</script>@endpush
@endsection
