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
                    <div class="card-body">
                        <div class="row">
                            @foreach($items as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img style="height: 150px" src="{{ asset($item->photo) }}" alt="">
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
                                            <input required min="0.0" step="any" type="number" placeholder="Quantity"
                                                   name="qty"
                                                   class="form-control w-75">
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                <span class="mdi mdi-cart-plus mdi-24px"></span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @endforeach
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
                        console.log(res);
                        if (res.isNew == 0){
                            $("#cart-list .cart-empty").hide();
                            $("#cart-list").append(`
                            <div class="w-100 px-2 d-flex align-items-center justify-content-between">
                                <div class="">
                                    <img class="img-thumbnail" src="${res.photo}" alt="">
                                </div>
                                <div class="">
                                    <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                        <b>${res.name}</b> <br>
                                        ${res.qty}x${res.item_price}EGP
                                    </p>
                                </div>
                                <div class="">
                                    <button class="btn btn-sm btn-danger mdi mdi-trash-can"></button>
                                </div>
                            </div>
`);
                        } else {
                            alert('update')
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
