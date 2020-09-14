@extends('layouts.app')

@section('content')
    @if(session()->has('cart'))
        @foreach(session('cart') as $ci)
        <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_{{$ci['id']}}">
                <div class="col-md-3">
                    <img class="img-fluid" src="{{$ci['photo']}}" alt="">
                </div>
                <div class="col-md-7">
                    <p style="line-height: 20px;font-size: 15px" class="mb-0">
                        <b>{{$ci['name']}}</b> <br>
                        {{$ci['qty']}}x{{$ci['item_price']}}EGP
                    </p>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-sm btn-danger mdi mdi-trash-can" 
                href = "{{ route('cart.remove', $ci['id'])}}"></a>
                </div>
            </div>
        @endforeach
        <a href = "{{route('cart.sendMail')}}" class = "btn btn-success btn-lg btn-block fixed-bottom">Complete Order</a>
    @else
        <div class="centered">There Is No Items In The Cart</div>
        <div class="text-center">
            <a href = "{{route('product.all')}}" class = "btn btn-primary btn-lg">Go Back Shopping</a>
        </div>
    @endif
@endsection