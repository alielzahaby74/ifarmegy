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
                        @foreach ($cats as $cat)
                            <form method = "POST" action="{{route('products.getList', $cat->id)}}">
                                @csrf
                                <div class="card">
                                    <input type="image" class="card-img-top submit" style="height: 200px" src="{{$cat->photo}}" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title text-center">{{$cat->name}}</h5>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                        @if(auth()->user()->admin)
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('product.all') }}">Products</a>
                        @if(auth()->user()->admin)

                        <a class="btn btn-primary btn-sm"
                           href="{{ route('category.all') }}">Categories</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
