@extends('layouts.app')
@section('title','Order Confirmed')
@section('content')<div class="container py-5 text-center"><div class="table-card mx-auto" style="max-width:620px"><h1>Order Confirmed</h1><p class="lead">Your order number is <strong>{{ $order->order_number }}</strong>.</p><p>Total: ৳{{ number_format($order->total_amount,2) }}</p><a class="btn btn-primary" href="{{ route('orders.show',$order) }}">Track Order</a></div></div>@endsection
