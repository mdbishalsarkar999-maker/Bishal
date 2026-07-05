@extends('layouts.app')
@section('title','Wishlist')
@section('content')<div class="container py-5"><h1>Wishlist</h1><div class="row g-4">@forelse($items as $item)<div class="col-md-3">@php($product=$item->product)@include('customer.partials.product-card')<form method="post" action="{{ route('wishlist.destroy',$item) }}" class="mt-2">@csrf @method('DELETE')<button class="btn btn-outline-danger w-100">Remove</button></form></div>@empty<p class="text-muted">No wishlist items yet.</p>@endforelse</div></div>@endsection
