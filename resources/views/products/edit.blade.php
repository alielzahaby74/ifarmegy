@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header">Add product</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                              action="{{ route('product.update',$item->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Product Name
                                        </label>
                                        <input required value="{{$item->name}}" name="item_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Product Price
                                        </label>
                                        <input required value="{{$item->price}}" name="item_price" step="any" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group autocomplete w-100">
                                        <label for="cat">Category</label>
                                        <input type="text" id="cat" class="form-control" />
                                        <input required value="{{$item->category_id}}" name="cat_id" type="hidden" id="cat_id" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Product Photo
                                        </label>
                                        <input name="item_photo" type="file" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary w-100">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
