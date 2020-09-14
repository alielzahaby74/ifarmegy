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
                            <a class="btn btn-primary btn-sm" href="{{ route('product.add') }}">Add Product</a>
                        @endif
                    </div>
                    @php
                        //dd(session('cart'));
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                @foreach($items as $item)
                                    @if($category->id == $item->category_id)
                                        <div class="col-md-4" style="margin-bottom: 10px" id = "data_{{$item->id}}">
                                            <div class="card">
                                                <div>
                                                <img class="img-thumbnail" style="height: 250px" src="{{ asset($item->photo) }}" alt="">
                                                </div>
                                                <div class="card-body">
                                                    <h3>{{ $item->name }}</h3>
                                                    <h5>
                                                        {{ $item->category()->first()->name }}
                                                        <span class="text-danger">
                                                            {{ $item->price."EGP" }}
                                                        </span>
                                                    </h5>
                                                </div>
                                                @if(auth()->user()->admin == true)
                                                    <div class="actions card-body pt-0 mt-0">
                                                        <a class="btn btn-danger btn-sm mdi mdi-trash-can"
                                                        href="{{ route('product.delete', $item->id) }}"></a>
                                                        <a class="btn btn-secondary mr-2 btn-sm mdi mdi-database-edit"
                                                        href="{{ route('product.edit', $item->id)}}"></a>
                                                    </div>
                                                @endif
                                                <form class="addToCartForm card-body mt-0 pt-0 d-flex"
                                                    action="{{route('cart.add')}}">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                                    <input required min="0.0" step="any" type="number" placeholder="KG"
                                                        name="qty"
                                                        class="form-control w-75">
                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <span class="mdi mdi-cart-plus mdi-24px"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
        const $ = window.$;
        $(document).ready(function (event) {
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
                            <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_${res.id}">
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
                                            <a class="btn btn-sm btn-danger mdi mdi-trash-can" 
                                        href = "{{ route('cart.remove')}}/${res.id}"></a>
                                        </div>
                                    </div>
`);
                        } else {
                            /*//sol 1 delete and append
                            $(`#data_${res.id}`).remove();
                            $("#cart-list").append(`
                            <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_${res.id}">
                                        <div class="col-md-3">
                                            <img class="img-fluid" src="${res.photo}" alt="">
                                        </div>
                                        <div class="col-md-7">
                                            <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                                <b>${res.name}</b> <br>
                                                ${res.qty}x${res.item_price}EGP
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-sm btn-danger mdi mdi-trash-can" 
                                        href = "{{ route('cart.remove')}}/${res.id}"></a>
                                        </div>
                                    </div>
`);*/
                            //sol 2 update the element
                            $("#item_qty_" + res.id).html(res.qty);
                        }
                    },
                    error: function (e) {
                        swal.fire("An error Happened", "", "error"),
                            console.log(e)
                    }
                });
            });
        })
    </script>
@endpush
