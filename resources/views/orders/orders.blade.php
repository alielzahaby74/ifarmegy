@extends('layouts.app')

@section('content')
<div class="container my-5">

  
    <!-- Section: Block Content -->
    <section>
      
      <div class="row">
        <div class="col-12">
            <div class="card card-list">
            <div class="card-header white d-flex justify-content-between align-items-center py-3">
              <p class="h5-responsive font-weight-bold mb-0">الطلبات</p>
              <ul class="list-unstyled d-flex align-items-center mb-0">
                <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
                <li><i class="fas fa-times fa-sm pl-3"></i></li>
              </ul>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">رقم الطلب</th>
                    <th scope="col">اسم العميل</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">رقم الهاتف</th>
                    <th scope="col">المبلغ</th>
                    <th scope="col">الحالة</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                  <tr>
                    <th scope="row"><a class="text-primary">{{$order->id}}</a></th>
                    <td>{{$order->user_name}}</td>
                    <td>{{$order->user_address}}</td>
                    <td>{{$order->phone_number}}</td>
                    <td>{{$order->total_cost}}</td>
                    <td class="pt-2 pb-0">
                        <a href = "{{route('orders.order', $order->id)}}">
                            <i class="fas fa-eye" style="color:blue;font-size: 45px;"></i>
                        </a>
                        <a href="{{route('order.complete', $order->id)}}">
                            <i class="fas fa-check-circle" style="color:green;font-size: 45px;"></i>
                        </a>
                        <a href="{{route('order.delete', $order->id)}}">
                            <i class="fas fa-times-circle"style="color:red;font-size: 45px;"></i>
                        </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!--<div class="card-footer white py-3 d-flex justify-content-between">
              <button class="btn btn-primary btn-md px-3 my-0 mr-0">Place New Order</button>
              <button class="btn btn-light btn-md px-3 my-0 ml-0">View All Orders</button>
            </div>-->
          </div>
        </div>
      </div>
  
    </section>
    <!-- Section: Block Content -->
  
    
  </div>
@endsection