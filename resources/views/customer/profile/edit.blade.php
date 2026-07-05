@extends('layouts.app')
@section('title','Profile')
@section('content')<div class="container py-5" style="max-width:620px"><div class="table-card"><h1>Profile</h1><form method="post" action="{{ route('profile.update') }}">@csrf @method('PUT')<input class="form-control mb-3" name="name" value="{{ $user->name }}"><input class="form-control mb-3" name="email" value="{{ $user->email }}" disabled><input class="form-control mb-3" name="phone" value="{{ $user->phone }}"><button class="btn btn-primary">Save</button></form></div></div>@endsection
