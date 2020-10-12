@extends('layouts.app')

@section('content')
    @if(session()->has('cart'))
    <div class="container z-depth-1 p-5 my-5">
        <!-- Section: Block Content -->
        <section>
            <!-- Shopping Cart table -->
            <div class="table-responsive">
            <table class="table product-table table-cart-v-1">
                <!-- Table head -->
                <thead>
                <tr>
                    <th></th>
                    <th class="font-weight-bold">
                    <strong>Product</strong>
                    </th>
                    <th></th>
                    <th class="font-weight-bold">
                    <strong>Price</strong>
                    </th>
                    <th class="font-weight-bold">
                    <strong>QTY</strong>
                    </th>
                    <th class="font-weight-bold">
                    <strong>Amount</strong>
                    </th>
                    <th></th>
                </tr>
                </thead>
                <!-- Table head -->
                <!-- Table body -->
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
                    <tr>
                      <th scope="row">
                        <img src="{{$ci['photo']}}" alt=""
                          class="img-fluid z-depth-0" style="height: 100px">
                      </th>
                      <td>
                        <h5 class="mt-3">
                          <strong>{{$ci['name']}}</strong>
                        </h5>
                        <p class="text-muted">Apple</p>
                      </td>
                      <td></td>
                      <td>${{$ci['item_price']}}</td>
                      <td class="text-center text-md-left">
                        <span class="qty">{{$ci['qty']}}</span>
                        <div class="btn-group radio-group ml-2" data-toggle="buttons">
                          <label class="btn btn-sm btn-primary btn-rounded">
                            <input type="radio" name="options" id="option1">&mdash;
                          </label>
                          <label class="btn btn-sm btn-primary btn-rounded">
                            <input type="radio" name="options" id="option2">+
                          </label>
                        </div>
                      </td>
                      <td class="font-weight-bold">
                        <strong>${{$ci['total']}}</strong>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                          title="Remove item">X
                        </button>
                      </td>
                    </tr>
                    <!-- First row -->

                    @endforeach
                <!-- Fourth row -->
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <h4 class="mt-2">
                        <strong>Total</strong>
                        </h4>
                    </td>
                    <td class="text-right">
                        <h4 class="mt-2">
                        <strong>$2600</strong>
                        </h4>
                    </td>
                    <td colspan="3" class="text-right">
                        <a href = "{{route('cart.sendOrder')}}" type="button" class="btn btn-primary btn-rounded px-4">Complete purchase
                        <i class="fas fa-angle-right right"></i>
                        </a>
                    </td>
                    </tr>
                    <!-- Fourth row -->
                </tbody>
                <!-- Table body -->
            </table>
            </div>
            <!-- Shopping Cart table -->
            </section>
            <!-- Section: Block Content -->
        </div>
    @else
        <div class="centered">There Is No Items In The Cart</div>
        <div class="text-center">
            <a href = "{{route('dash')}}" class = "btn btn-primary btn-lg">Go Back Shopping</a>
        </div>
    @endif
    
@endsection