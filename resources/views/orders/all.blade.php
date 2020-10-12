@extends('layouts.app')

@section('content')
<div class="container my-5">


    <!--Section: Content-->
    <section class="magazine-section dark-grey-text">
    
        <!-- Grid row -->
    <div class="row">

        <!-- Grid column -->
        <div class="col-lg-10 col-md-12 mb-4">
            @foreach($orders as $order)
            <button type="button" class="" style="border: none;border-bottom: solid 1px blue;" data-toggle="modal" data-target="#exampleModal">
        <!-- Small news -->
        <div class="single-news mb-4">

            <!-- Grid row -->
            <div class="row">

            <!-- Grid column -->
            <div class="col-md-3">

                <!--Image-->
                <div class="view overlay rounded z-depth-1 mb-4">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(29).jpg" alt="Sample image">
                <a>
                    <div class="mask rgba-white-slight"></div>
                </a>
                </div>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            
            <div class="col-md-9">

                <!-- Excerpt -->
                <p class="font-weight-bold dark-grey-text">26/02/2018</p>
                <div class="d-flex justify-content-between">
                <div class="col-11 text-truncate pl-0 mb-3">
                <a href="#!" class="dark-grey-text">{{$order->description}}</a>
                </div>
                <a><i class="fas fa-angle-double-right"></i></a>
                </div>

            </div>
            
            <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
            </button>
        <!-- Small news -->
        @endforeach
        
        </div>
        <!--Grid column-->

    </div>
    <!-- Grid row -->
    
    </section>
    <!--Section: Content-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection