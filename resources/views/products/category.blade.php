@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @component('comps.errors') @endcomponent

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                      
                        @if(auth()->user()->admin == true)
                            <a class="btn btn-primary btn-sm h2" href="{{ route('product.add') }}">أضف منتج</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row flex-row">
                            @foreach($items as $item)
                                @if($item->category_id == $id)

                                    <!-- loop over this to display the items  -->
                                    <div class="col-lg-4 col-md-6 col-6 mb-4">
                                      <!-- Card -->
                                      <div class="card card-ecommerce">
                                        <!-- Card image -->
                                        <div class="view overlay">
                                        <img style="width: 100%;height:150px;" src="{{asset($item->photo)}}" class="img-fluid"
                                            alt="">
                                          <a>
                                            <div class="mask rgba-white-slight"></div>
                                          </a>
                                        </div>
                                        <!-- Card image -->
                                        <!-- Card content -->
                                        <div class="card-body">
                                          <!-- Category & Title -->
                                          <h5 class="card-title mb-1">
                                            <strong>
                                            <p class="dark-grey-text">{{$item->name}}</a>
                                            </strong>
                                          </h5>
                                          <span class="badge badge-danger mb-2">فواكه</span>
                                          <div class="PRICE-BOX">
                                             <span style="direction: rtl;">1 {{$item->unit}} = {{$item->price}} جنية</span>
                                          </div>
                                          <!-- Card footer -->
                                          <div class="pb-0">
                                            <div class="mb-0 d-flex flex-row align-items-center">
                                              <div class="price-input">
                                                <form method = "POST" class="addToCartForm" 
                                                action="{{route('cart.add')}}" id="from{{$item->id}}" >
                                                @csrf
                                                    <input type="hidden" name = "item_id" value="{{$item->id}}">
                                                    <input type="hidden" name = "item_step" value="{{$item->step}}">
                                                    <input id="test" min = "0.0" step = "any" name = "qty" type="number" class="qty w-100 form-control">
                                                    <div class="price-btns d-flex flex-column" data-step="{{$item->step}}">
                                                    <a class="inc-num"><span class="mdi mdi-chevron-up"></span></a>
                                                    <a class="dec-num"><span class="mdi mdi-chevron-down"></span></a>  
                                                </div>
                                            </div>
                                                <input type="text" disabled readonly value="ك.ج" class="w-25 ml-2 form-control">
                                                <button class="btn btn-primary btn-sm py-1 px-2"><span class="mdi mdi-cart-plus mdi-24px"></span></button>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Card content -->
                                      </div>
                                      <!-- Card -->
                                    </div>
                                    <!-- loop over this to display the items  -->
                                @endif
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
