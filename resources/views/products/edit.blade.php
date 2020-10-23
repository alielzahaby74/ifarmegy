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
                                            اسم المنتج
                                        </label>
                                        <input required value="{{$item->name}}" name="item_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            سعر المنتج
                                        </label>
                                        <input required value="{{$item->price}}" name="item_price" step="any" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group autocomplete w-100">
                                        <label for="cat">نوع المنتج</label>
                                        <input type="text" autocomplete="off" id="cat" class="form-control" />
                                        <input required value="{{$item->category_id}}" name="cat_id" type="hidden" id="cat_id" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            صورة المنتج 
                                        </label>
                                        <input name="item_photo" value="{{$item->photo}}" type="file" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            غير متاح
                                        </label>
                                        <input name="not_available" @if($item->not_available) checked @endif type="checkbox" class="form-control-check">
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
@push("js")
    <script>
        let cats = [ @foreach(\App\Models\Category::all() as $p) {name:"{{ $p->name }}",id:{{ $p->id }}}, @endforeach ];
        autocomplete2(document.getElementById("cat"),cats,document.getElementById("cat_id"))
    </script>
@endpush