@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        <div id="carouselExampleIndicators" class="carousel slide slider demo" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" style="max-height: 300px" src="https://via.placeholder.com/150" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="max-height: 300px" src="https://via.placeholder.com/150" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="max-height: 300px" src="https://via.placeholder.com/150" alt="Third slide">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
    </div>

</div>


@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('.demo').slick();
        });
    </script>
@endpush
