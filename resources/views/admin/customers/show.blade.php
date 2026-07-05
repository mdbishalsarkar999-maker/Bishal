@extends('layouts.admin')
@section('title','Customer History')
@section('content')<div class="table-card"><h4>{{ $customer->name }}</h4><p>{{ $customer->email }} | {{ $customer->phone }}</p><table class="table"><tr><th>Order</th><th>Status</th><th>Total</th><th>Date</th></tr>@foreach($customer->orders as $order)<tr><td>{{ $order->order_number }}</td><td>{{ $order->status }}</td><td>৳{{ number_format($order->total_amount,2) }}</td><td>{{ $order->created_at->format('d M Y') }}</td></tr>@endforeach</table></div>@endsection
