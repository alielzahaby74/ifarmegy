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
                                        <form method="POST" action="{{ route('cart.add', [
                                            "id" => $item->id,
                                            "name" => $item->name,
                                            "price" => $item->price,
                                            ])}}">
                                            @csrf
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
                                                <input type="number" placeholder="Quantity" name="item_quantity" class="form-control">
                                                <input class = "" type="submit" value="AddToCart">
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
