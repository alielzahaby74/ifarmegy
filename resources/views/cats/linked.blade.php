@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        All Products in {{ $cat->name }}
                        <a class="btn btn-primary btn-sm" href="{{ route('category.add') }}">Add Product</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table-hover table">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cat->products()->get() as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
