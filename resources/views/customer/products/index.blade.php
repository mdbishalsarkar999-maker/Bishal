@extends('layouts.app')
@section('title','Products')
@section('content')
<div class="container py-5"><div class="row g-4"><aside class="col-lg-3"><form class="table-card"><h5>Filters</h5><select class="form-select mb-3" name="category"><option value="">All categories</option>@foreach($categories as $category)<option value="{{ $category->slug }}" @selected(request('category')==$category->slug)>{{ $category->name }}</option>@endforeach</select><input class="form-control mb-3" name="min_price" placeholder="Min price" value="{{ request('min_price') }}"><input class="form-control mb-3" name="max_price" placeholder="Max price" value="{{ request('max_price') }}"><button class="btn btn-primary w-100">Apply</button></form></aside><div class="col-lg-9"><div class="row g-4">@foreach($products as $product)<div class="col-sm-6 col-xl-4">@include('customer.partials.product-card')</div>@endforeach</div><div class="mt-4">{{ $products->links() }}</div></div></div></div>
@endsection
