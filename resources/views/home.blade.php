@extends('layouts.app')

@section('content')
<section>

    <!-- Carousel Wrapper -->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
      </ol>
      <!-- Indicators -->
      <!-- Slides -->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="view">
            <a href="">
              <img class="d-block w-100" 
              src="https://ebtikar-it.com/wp-content/uploads/2017/01/banner-web-design.png" alt="First slide">
                <div class="mask rgba-white-slight text-center d-flex align-items-center justify-content-center">
                  <div class="row">
                    <div class="col-12">
                    </div>
                  </div>
                </div>
                 </a>
          </div>
        </div>
        <div class="carousel-item">
          <div class="view">
            <a href="">
              <img class="d-block w-100" 
              src="https://ebtikar-it.com/wp-content/uploads/2017/01/banner-web-design.png" alt="second slide">
                <div class="mask rgba-white-slight text-center d-flex align-items-center justify-content-center">
                  <div class="row">
                    <div class="col-12">
                    </div>
                  </div>
                </div>
                 </a>
          </div>
        </div>
     </div>
      <!-- Slides -->
      <!-- Controls -->
      <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!-- Controls -->
    </div>
    <!-- Carousel Wrapper -->
  
  </section>
  <!-- Section: Block Content -->
  
  <section class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="d-flex align-items-center">
            <span class="mdi mdi-tag-outline mr-2"></span>
            <span>اقسام الموقع</span>
          </h2>
        </div>
      </div>
      <div class="row cats-slider">
        <!-- loop over this to display the categories  -->
        @foreach($categories as $category)
        <div class="px-2 flex-row card d-flex flex-row align-items-center">
          <div class="py-2 pl-2">
            <img style="height: 100px;width:100px" class="waves-effect rounded-circle" src="{{$category->photo}}" alt="">  
          </div>
          <div class="text pl-2">
            <a href="{{route('products.getList', $category->id)}}">
            <h4 class="mb-0">{{$category->name}}</h4>
            </a>
            <!--<h6>عدد الاقسام</h6>-->
          </div>
        </div>
        @endforeach
        <!-- loop over this to display the categories  -->
      </div>
    </div>
  </section>
  
  <hr class="w-50 red">
  
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="d-flex align-items-center">
            <span class="mdi mdi-shopping mr-2"></span>
            <span>ابرز المنتجات</span>
          </h2>
        </div>
      </div>
      <div class="row flex-row">
        <!-- loop over this to display the items  -->
        @foreach($items as $item)
          <div class="col-lg-3 col-md-6 mb-4">
            <!-- Card -->
            <div class="card card-ecommerce">
              <!-- Card image -->
              <div class="view overlay">
              <img style="width: 100%;height:150px;" src="{{$item->photo}}" class="img-fluid"
                  alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card image -->
              <!-- Card content -->
              <div class="card-body text-right">
                <!-- Category & Title -->
                <h5 class="card-title mb-1">
                  <strong>
                    <p class="dark-grey-text">{{$item->name}}</a>
                  </strong>
                </h5>
                <span class="badge badge-danger mb-2">{{$item->category()->first()->name}}</span>
                <div class="PRICE-BOX">
                  <span style="">1 {{$item->unit}} = {{$item->price}} جنية</span>
                </div>
                <!-- Card footer -->
                <form method = "POST" class="addToCartForm" 
                  action="{{route('cart.add')}}" id="from{{$item->id}}" >
                  @csrf
                  <input type="hidden" name = "item_id" value="{{$item->id}}">
                  <input type="hidden" name = "item_step" value="{{$item->step}}">
                  <div class="pb-0">
                    <div class="mb-0 d-flex flex-row align-items-center">
                      <div class="price-input">
                        <input id="test" type="number" min="0.0" step="any" class="qty w-100 form-control" name="qty">
                        <div class="price-btns d-flex flex-column" data-step="{{$item->step}}">
                          <a class="inc-num"><span class="mdi mdi-chevron-up"></span></a>
                          <a class="dec-num"><span class="mdi mdi-chevron-down"></span></a>  
                        </div>
                      </div>
                      <input type="text" disabled readonly value="ك.ج" class="d-none d-md-inline w-25 px-1 text-center ml-2 form-control">
                      <button class="btn btn-primary btn-sm py-1 px-2"><span class="mdi mdi-cart-plus mdi-24px" style="margin-left: 10px"></span></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- Card content -->
            </div>
            <!-- Card -->
          </div>
        @endforeach
        <!-- loop over this to display the items  -->
      </div>
  
    </div>
  </section>
  
  <!--Footer-->
  <footer class="page-footer text-center font-small grey darken-3">
  
    <div class="rgba-stylish-strong">
  
      <hr class="my-4">
  
      <!-- Social icons -->
      <div class="pb-4">
        <a href="https://www.facebook.com/Ifarm-106467257824316" target="_blank">
          <i class="fab fa-facebook-f mr-3"></i>
        </a>
  
        <a href="https://twitter.com/MDBootstrap" target="_blank">
          <i class="fab fa-twitter mr-3"></i>
        </a>

        <a  href="https://instagram.com/MDBootstrap" target="_blank">
          <i class="fab fa-instagram mr-3"></i>
        </a>

  
      </div>
      <!-- Social icons -->
  
      <!--Copyright-->
      <div class="footer-copyright py-3">
        © 2020 Copyright:
      </div>
      <!--/.Copyright-->
  
    </div>
  
  </footer>
  <!--Footer-->
@endsection
@push('js')
    <script>
  $(".cats-slider").slick({
    slidesToShow:3,
    rtl: true,
    centerMode: true,
    responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
  });
</script>

@endpush