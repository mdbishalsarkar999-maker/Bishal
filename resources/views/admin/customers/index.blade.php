@extends('layouts.admin')
@section('title','Customers')
@section('content')<div class="table-card"><table class="table"><tr><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th></th></tr>@foreach($customers as $customer)<tr><td>{{ $customer->name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone }}</td><td>{{ $customer->orders_count }}</td><td><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.customers.show',$customer) }}">History</a></td></tr>@endforeach</table>{{ $customers->links() }}</div>@endsection
