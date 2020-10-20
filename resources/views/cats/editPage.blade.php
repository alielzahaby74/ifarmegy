@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header">تعديل النوع</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                            action="{{ route('category.edit', $cat->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            اسم النوع
                                        </label>
                                        <br>
                                    <input  type="text" vlaue = {{$cat->name}} name="item_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            الصورة
                                        </label>
                                        <br>
                                    <input name="item_photo" value="{{$cat->photo}}" type="file" class="">
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
