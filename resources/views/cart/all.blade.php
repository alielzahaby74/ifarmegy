@extends('layouts.app')

@section('content')
<div class="container z-depth-1 p-5 my-5">
  <!-- Section: Block Content -->
        <section>
          <!-- Shopping Cart table -->
          <div class="table-responsive">
            <table class="table product-table table-cart-v-1" style="direction: rtl">
                <!-- Table head -->
                <thead>
                <tr>
                    <th class="text-right">الصورة</th>
                    <th class="font-weight-bold text-right">
                      <strong>المنتج</strong>
                    </th>
                    <th class="font-weight-bold text-right"></th>
                    <th class="font-weight-bold text-right">
                    <strong >السعر</strong>
                  </th>
                    <th class="font-weight-bold text-right">
                    <strong>الكمية</strong>
                  </th>
                    <th class="font-weight-bold text-right">
                    <strong>السعر الكلي</strong>
                  </th>
                    <th class="text-right">حذف</th>
                  </tr>
                </thead>
                <!-- Table head -->
                <!-- Table body -->
          @if(session()->has('cart'))
                <tbody>
        @foreach(session('cart') as $ci)
        <!--<div class="row px-2 d-flex align-items-center" id = "data_{{$ci['id']}}">
            <div class="col-3">
                <img class="img-fluid w-50" src="{{$ci['photo']}}" alt="">
            </div>
            <div class="col-7">
                <p style="line-height: 20px;font-size: 15px" class="mb-0">
                    <b>{{$ci['name']}}</b> <br>
                    {{$ci['qty']}}x{{$ci['item_price']}}EGP
                </p>
            </div>
            <div class="col-2">
                <a class="btn btn-sm btn-danger mdi mdi-trash-can" 
            href = "{{ route('cart.remove', $ci['id'])}}"></a>
            </div>
        </div>-->


                    <!-- First row -->
                    <tr class = "data_{{$ci['id']}}">
                      <th class="text-right align-middle" scope="row">
                        <img src="{{$ci['photo']}}" alt=""
                          class="img-fluid z-depth-0" style="height: 100px; width: 150px;">
                      </th>
                      <td class="text-right align-middle">
                        <h5 class="mt-3">
                          <strong>{{$ci['name']}}</strong>
                        </h5>
                        <!--<p class="text-muted">Apple</p>-->
                      </td>
                      <td class="text-right align-middle"></td>
                      <td class="text-right align-middle" style="font-weight: bold">{{$ci['item_price']}}جنية</td>
                      <td class="text-right align-middle">
                        <!--<span class="qty">{{$ci['qty']}}</span>-->
                          <div class="pb-0 w-50">
                            <div class="mb-0 d-flex flex-row align-items-center">
                              <strong class="mx-2" style="font-weight: bold" id = "item_cart_qty_{{$ci['id']}}">{{$ci['qty']}}</strong>
                              <div class="price-input">
                                <form method = "POST" class="addToCartForm"  style="min-width: 75px;"
                                action="{{route('cart.add')}}" id="from{{$ci['id']}}" data-total = "{{$ci['total']}}">
                                @csrf
                                    <input type="hidden" name = "item_id" value="{{$ci['id']}}">
                                    <input id="test" min = "0.0" step = "any" name = "qty" type="number" class="qty w-100 form-control">
                                  <div class="price-btns d-flex flex-column" data-step="{{$ci['step']}}">
                                    <a class="inc-num"><span class="mdi mdi-chevron-up"></span></a>
                                    <a class="dec-num"><span class="mdi mdi-chevron-down"></span></a>  
                                  </div>
                                </div>
                                  <button class="btn btn-primary btn-sm py-1 px-2" style="min-width: 35px;"><span class="mdi mdi-cart-plus mdi-24px" style="margin-left: 10px"></span></button>
                                </form>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="font-weight-bold text-right align-middle">
                        <strong style="font-weight: bold" id = "item_{{$ci['id']}}_price">{{$ci['total']}}جنية</strong>
                      </td>
                      <td class="text-right align-middle">
                        <a href = "{{ route('cart.remove', $ci['id'])}}" class="cart_delete_btn btn btn-sm btn-primary"
                        data-target = "data_{{$ci['id']}}" data-price = "{{$ci['total']}}"title="Remove item">X
                      </a>
                      </td>
                    </tr>
                    <!-- First row -->

                    @endforeach
                  <tr>
                    <td colspan = "4" class="text-right">
                      <h4 class="mt-2">
                        <h2 class="d-flex align-items-center">
                          <span class="mdi mdi-cash-usd-outline mr-2"></span>
                          <span>طريقة الدفع</span>
                        </h2>
                      <input type="radio" name="payment_method" value="visa">
                      <h5 style="display: inline;"><label>Visa</label></h5>
                        <img src="{{asset('visa.svg')}}" style="height: 50px">
                        <span>*يتم إيصال عامل التوصيل بماكينة الفيزا*</span>
                        <br>
                        <input type="radio" name="payment_method" value="cash">
                        <h5 style="display: inline;"><label>Cash</label></h5>
                        <img src="{{asset('cash-payment.svg')}}" style="height: 50px">
                      </h4>
                    </td>
                    <td colspan="4"></td>
                    <td colspan="4" class="text-right">
                      <!--<h4 class="mt-2">
                        <h2 class="d-flex align-items-center">
                          <span class="mdi mdi-timer-outline mr-2"></span>
                          <span>ميعاد التوصيل</span>
                        </h2>
                      <input type="radio" name="payment_method">
                      <h5 style="display: inline;"><label> الميعاد الصباحي(1 - 9) ظهرا</label></h5>
                        <img src="{{asset('sunrise.svg')}}" style="height: 50px">
                        <br>
                        <input type="radio" name="payment_method">
                        <h5 style="display: inline;"><label>الميعاد المسائي</label></h5>
                        <img src="{{asset('mountain.svg')}}" style="height: 50px">
                      </h4>-->
                    </td>
                  </tr>
                <!-- Fourth row -->
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <h4 class="mt-2">
                        <strong>السعر الكلي</strong>
                        </h4>
                    </td>
                    <td class="text-right">
                        <h4 class="mt-2">
                          <strong id = "order_price">{{$total_cost}}</strong>
                          <span> جنية </span>
                        </h4>
                    </td>
                    
                    
                    <td colspan="3" class="text-right">
                      <a href = "{{route('order.sendOrder')}}" type="button" class="btn btn-primary btn-rounded px-4">اطلب الآن
                        <i class="fas fa-angle-right right"></i>
                      </a>
                    </td>
                    <br>
                    
                  </tr>
                  <!--<tr>
                    <td colspan="3"></td>
                    <td colspan="3" class="text-right"><h4>+ التوصيل 20-30 ج</h4></td>
                    
                  </tr>-->
                  <!-- Fourth row -->
                </tbody>
                <!-- Table body -->
              </table>
            </div>
            <!-- Shopping Cart table -->
            </section>
            <!-- Section: Block Content -->
        </div>
      @endif
@endsection