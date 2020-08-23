@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="">
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('product.all') }}">Products</a>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('category.all') }}">Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
