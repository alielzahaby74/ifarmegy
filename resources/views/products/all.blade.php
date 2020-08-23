@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        All products
                        <a class="btn btn-primary btn-sm" href="{{ route('product.add') }}">Add Product</a>
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
                                        <div class="actions card-body pt-0 mt-0">
                                            <a class="btn btn-danger btn-sm mdi mdi-trash-can"
                                               href=""></a>
                                            <a class="btn btn-secondary mr-2 btn-sm mdi mdi-database-edit" href=""></a>
                                        </div>
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
