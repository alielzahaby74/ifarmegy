<!doctype html>
<html dir = "rtl" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iFruit') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <!-- Styles -->
    <link href="{{ asset('sw/sweetalert2.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.css')}}">

    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light white">

        <div class="container flex-row"> 
    
        <a class="navbar-brand d-flex align-items-center flex-row-" href="/">
        
        <img src="{{asset('logo.jpeg')}}" style="height: 50px">
        <span style="font-weight: 500;" class="ml-2 mt-1">IFarm</span>
        </a>
        
        <!--<ul class="nav navbar-nav nav-flex-icons mr-0 d-md-inline d-lg-none" style="">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="badge red z-depth-1 mr-1" id="cart_item_qty">
                        {{session()->has('cart') ? count(session('cart')) : 0}} 
                    </span>
                    <i id="navbar-static-cart " alt="Cart" class="fas fa-shopping-cart"></i>
                </a>
                <div id="cart-list" style="width: 350px" class="dropdown-menu col-md-4" aria-labelledby="navbarDropdown">
                    @if(session()->has('cart'))
                        @foreach(session('cart') as $ci)
                            <div class="row px-2 d-flex align-items-center justify-content-between data_{{$ci['id']}}" id = "data_{{$ci['id']}}">
                                <div class="col-3">
                                    <img class="img-fluid" src="{{$ci['photo']}}" alt="">
                                </div>
                                <div class="col-7">
                                    <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                        <b>{{$ci['name']}}</b> <br>
                                    <span id="item_qty_{{$ci['id']}}">{{$ci['qty']}}</span>x{{$ci['item_price']}}EGP
                                    </p>
                                </div>
                                <div class="col-2">
                                <a href = "/dash/cart/remove/{{$ci['id']}}" class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can"
                                    data-target = "data_{{$ci['id']}}" data-price = "{{$ci['total']}}"title="Remove item"></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-2 text-center cart-empty">
                            العربة فارغة
                        </div>
                    @endif
                </div>
            </li>
        </ul>-->
        <!--<div class="nav-item avatar dropdown d-md-none d-clock">
            @if(session()->has('cart'))
                @foreach(session('cart') as $ci)
                    <div class="row px-2 d-flex align-items-center justify-content-between data_{{$ci['id']}}" id = "data_{{$ci['id']}}">
                        <div class="col-3">
                            <img class="img-fluid" src="{{$ci['photo']}}" alt="">
                        </div>
                        <div class="col-7">
                            <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                <b>{{$ci['name']}}</b> <br>
                            <span id="item_qty_{{$ci['id']}}">{{$ci['qty']}}</span>x{{$ci['item_price']}}EGP
                            </p>
                        </div>
                        <div class="col-2">
                            <a class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can" data-target = "data_{{$ci['id']}}"
                            data-price = "{{$ci['total']}}" href = "">
                    
                        </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-2 text-center cart-empty">
                    No Items
                </div>
            @endif
        </div>-->
    
          <!-- Collapse button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                  aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <!-- Links -->
            <div class="collapse navbar-collapse flex-row-" id="basicExampleNav">
      
            <!-- Left -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ url('/') }}" >الصفحة الرئيسية </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{route('cart.all')}}">العربة </a>
                    </li>
                    @if(!Auth::guest())
                        @if(auth()->user()->admin == true)
                            <li class="nav-item">
                            <a class="nav-link waves-effect" href="{{route('orders.orders')}}">الطلبات </a>
                            </li>
                        @endif
                    @endif
                </ul>
      
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
              <li class="nav-item">
                @guest
                <div class="d-flex flex-column align-items-center">

                    <a style="font-size: 12px;font-weight: 500;" href="{{route('login')}}" class="px-3 nav-link waves-effect white-text btn orange darken-4 btn-rounded btn-sm">
                        تسجيل الدخول
                    </a>
                    <a style="font-size: 12px;font-weight: 500;" href="{{route('register')}}" >
                    
                        ليس لديك حساب؟
                    </a>
                </div>
                
                @else
                <a style="font-size: 12px;font-weight: 500;" href="{{route('logout')}}" class="px-3 nav-link waves-effect white-text btn orange darken-4 btn-rounded btn-sm"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    تسجيل الخروج
                </a>
                @endguest
            </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <ul class="nav navbar-nav nav-flex-icons mr-0 d-lg-inline d-none">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge red z-depth-1 mr-1" id="cart_item_qty">
                            {{session()->has('cart') ? count(session('cart')) : 0}} 
                        </span>
                        <i id="navbar-static-cart " alt="Cart" class="fas fa-shopping-cart"></i>
                    </a>
                    <div id="cart-list" style="width: 350px" class="dropdown-menu col-md-4" aria-labelledby="navbarDropdown">
                        @if(session()->has('cart'))
                            @foreach(session('cart') as $ci)
                                <div class="row px-2 d-flex align-items-center justify-content-between data_{{$ci['id']}}" id = "data_{{$ci['id']}}">
                                    <div class="col-3">
                                        <img class="img-fluid" src="{{$ci['photo']}}" alt="">
                                    </div>
                                    <div class="col-7">
                                        <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                            <b>{{$ci['name']}}</b> <br>
                                        <span id="item_qty_{{$ci['id']}}">{{$ci['qty']}}</span>x{{$ci['item_price']}}EGP
                                        </p>
                                    </div>
                                    <div class="col-2">
                                    <a href = "/cart/remove/{{$ci['id']}}" class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can"
                                            data-target = "data_{{$ci['id']}}" data-price = "{{$ci['total']}}"title="Remove item">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-2 text-center cart-empty">
                                العربة فارغة
                            </div>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    
        </div>
    
    </nav>
    
    <main class="py-4">
        @yield('content')
        
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset('sw/sweetalert2.js') }}"></script>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('js/mdb.js')}}"></script>
<script src="{{asset('slick/slick.js')}}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    @if(session()->has('status'))
    swal.fire("{{ session('msg') }}","{{ session('msg2') }}","{{ session('type') }}");
    @endif
</script>
<script>
    
    $(document).on('click', '.cart_delete_btn', function(e){
            e.preventDefault();
            
        //console.log($(this).data('target'));
        let class_name = "." + $(this).data('target');
        let item_price = $(this).data('price');
        item_price = parseFloat(item_price);
        let order_price_ele = $('#order_price');
        let new_price =  parseFloat(order_price_ele.text()) - item_price;
        order_price_ele.text(new_price);
        $(this).parent().parent().remove();
        $(class_name).remove();
        let qty = parseInt($("#cart_item_qty").text());
        if(qty > 0)
            --qty;
        if(qty == 0)
            $("#cart-list .cart-empty").show();
        $("#cart_item_qty").text(qty);
        $.ajax({
            url: $(this).attr('href'),
            method: "GET",
        });
    });
</script>

@stack("js")

<script>

</script>
</body>
</html>
