@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        All products
                        @if(auth()->user()->admin == true)
                            <a class="btn btn-primary btn-sm h2" href="{{ route('product.add') }}">أضف منتج</a>
                        @endif
                    </div>
                    @php
                        //dd(session('cart'));
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            @foreach($items as $item)
                                @if($item->category_id == $id)
                                    <div class="col-md-4 col-sm-6 col-6 text-center" style="margin-bottom: 10px" id = "data_{{$item->id}}">
                                        <div class="card">
                                            <div>
                                            <img class="img-thumbnail" style="height: 250px" src="{{ asset($item->photo) }}" alt="">
                                            </div>
                                            <div class="card-body">
                                                <h3>{{ $item->name }}</h3>
                                                <h5>
                                                    <span class="text-danger">
                                                        {{ $item->price."EGP" }}
                                                    </span>
                                                </h5>
                                            </div>
                                            @if(auth()->user()->admin == true)
                                                <div class="actions card-body pt-0 mt-0 text-center">
                                                    <a class="delete_btn btn btn-danger btn-sm mdi mdi-trash-can"
                                                    href="{{ route('product.delete', $item->id) }}"></a>
                                                    <a class="btn btn-secondary mr-2 btn-sm mdi mdi-database-edit"
                                                    href="{{ route('product.edit', $item->id)}}"></a>
                                                </div>
                                            @endif
                                            
                                            <div class="badge badge-success w-25 m-auto">{{$item->unit}}</div>
                                            <br>
                                            <form method = "POST" class="addToCartForm card-body mt-0 pt-0" 
                                            action="{{route('cart.add')}}" id="from{{$item->id}}">
                                                @csrf
                                                <div class="d-flex justify-content-center">
                                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                                    <input type="hidden" name="step" value="{{$item->step}}">
                                                    
                                                    <button class="inc-num btn btn-primary btn-sm" id = "{{$item->id}}">
                                                        +
                                                    </button>
                                                    <input min="0.0" step="{{$item->step}}" type="number"
                                                        name="qty"
                                                        class="qty form-control w-50">
                                                    
                                                        
                                                        <button class="btn btn-primary btn-sm">
                                                            <!--<span class="mdi mdi-cart-plus mdi-24px"></span>-->
                                                            -
                                                        </button>
                                                    </div>
                                                    <button class = "mdi mdi-cart-plus mdi-24px btn btn-primary"type="submit"></button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <a class = "btn btn-success btn-lg btn-block fixed-bottom" href="{{route('cart.all')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
{{--@php session()->remove('cart') @endphp--}}
@push("js")
    <script>
        
        // global scope
        $(".addToCartForm").on('submit', function (e) {
        // global , local
        e.preventDefault();
        let _that = $(this);
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            success: function (res) {
                _that.trigger("reset");
                //console.log(res);
                if (res.isNew == 0){
                    $("#cart-list .cart-empty").hide();
                    let qty = parseInt($("#cart_item_qty").text()); ++qty;
                    $("#cart_item_qty").text(qty);
                    $("#cart-list").append(`
                            <div class="row px-2 d-flex align-items-center justify-content-between" name = "data_${res.id}" id = "data_${res.id}">
                                <div class="col-md-3">
                                    <img class="img-fluid" src="${res.photo}" alt="">
                                </div>
                                <div class="col-md-7">
                                    <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                        <b>${res.name}</b> <br>
                                        <span id="item_qty_${res.id}">${res.qty}</span>x${res.item_price}EGP
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <a class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can" 
                                href = "{{ route('cart.remove')}}/${res.id}"></a>
                                </div>
                            </div>
                            `);
                } else {

                    $("#item_qty_" + res.id).html(res.qty);
                }
            },
            error: function (e) {
                swal.fire("An error Happened", "", "error"),
                    console.log(e)
            }
        });
    });

    </script>
@endpush
