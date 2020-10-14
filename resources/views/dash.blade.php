@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #3f51b5; color: #fff">
                    {{ __('Dashboard') }}
                    @if(auth()->user()->admin)
                    <a class="btn btn-primary btn-sm"
                       href="{{ route('product.all') }}">المنتجات</a>

                    <a class="btn btn-primary btn-sm"
                       href="{{ route('category.all') }}">الأنواع</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="">
                        @foreach ($cats as $cat)
                            <div class="view overlay z-depth-1-half mb-2">
                            <img src="{{asset($cat->photo)}}" class="img-fluid" alt="">
                                <a href="{{route('products.getList', $cat->id)}}">
                                    <div class="position-absolute align-middle"  style="color: #FFF;z-index: 2;top: 30%;text-align: center;width:100%;font-size: 100px;"> {{$cat->name}}</div>
                                  <div class="mask rgba-white-light"></div>
                                </a>
                              </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
