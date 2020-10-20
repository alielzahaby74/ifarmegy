@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        All Categories
                        <a class="btn btn-primary btn-sm" href="{{ route('category.add') }}">Add Category</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table-hover table">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm mdi mdi-trash-can" 
                                                href="{{route('category.delete', $item->id)}}"></a>
                                            <a class="btn btn-secondary btn-sm mdi mdi-database-edit" 
                                                href="{{route('category.edit', $item->id)}}"></a>
                                            <a class="btn btn-primary mr-2 btn-sm mdi mdi-eye"
                                                href="{{ route('category.products', ['id'=>$item->id]) }}"></a>
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
