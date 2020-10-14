@extends('layouts.app')

@section('content')
<div class="container my-5">

  
    <!-- Section: Block Content -->
    <section>
      
      <div class="row">
        <div class="col-12">
            <div class="card card-list">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">الكمية</th>
                    <th scope="col">السعر</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($order as $items)
                  <tr>
                    <th scope="row"><a class="text-primary">{{$items->item_name}}</a></th>
                    <td>{{$items->qty}}</td>
                    <td><span class="badge badge-danger">{{$items->item_total}}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer white py-3 d-flex justify-content-between">
              <button class="btn btn-success btn-md px-3 my-0 mr-0">Done</button>
            </div>
          </div>
        </div>
      </div>
  
    </section>
    <!-- Section: Block Content -->
  
    
  </div>
@endsection