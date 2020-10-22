@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                      @if(Auth::check())
                        @if(auth()->user()->admin == true)
                            <a class="btn btn-primary btn-sm h2" href="{{ route('product.add') }}">أضف منتج</a>
                        @endif
                      @endif
                    </div>
                    <div class="card-body">
                        <div class="row flex-row">
                            @foreach($items as $item)
                                @if($item->category_id == $id)
                                <div class="col-lg-4 col-md-6 col-6 mb-4">
                                  @component('layouts.components.availableProduct')
                                    @slot('item_category')
                                      {{$item->category()->first()->name}}
                                    @endslot
                                    @slot('item_photo')
                                      {{$item->photo}}
                                    @endslot
                                    @slot('item_name')
                                        {{$item->name}}
                                    @endslot
                                    @slot('item_price')
                                        {{$item->price}}
                                    @endslot
                                    @slot('item_unit')
                                        {{$item->unit}}
                                    @endslot
                                    @slot('item_step')
                                        {{$item->step}}
                                    @endslot
                                    @slot('item_id')
                                        {{$item->id}}
                                    @endslot
                                  @endcomponent
                                </div>
                                    <!-- loop over this to display the items  -->
                                    
                                    <!-- loop over this to display the items  -->
                                @endif
                            @endforeach
                            <a class = "btn btn-success btn-lg btn-block fixed-bottom m-0" href="{{route('cart.all')}}">تفحص العربة</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
