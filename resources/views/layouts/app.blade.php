<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iFruit') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('sw/sweetalert2.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
<div id="app">
    @if(!Auth::guest())
    <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark indigo">

    <div class="container">
  
      <a class="font-weight-bold navbar-brand py-0" href="#">Ifarm</a>
  
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="basicExampleNav">
  
        <!-- Links -->
        <ul class="navbar-nav mr-auto text-uppercase">
          <li class="nav-item active">
            <a class="nav-link font-weight-normal" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-normal" href="{{ route('cart.all') }}">Cart</a>
        </li>
        @if(auth()->user()->admin)
            <li class="nav-item">
                <a class="nav-link font-weight-normal" href="{{ route('product.orders') }}">Orders</a>
            </li>
        @endif
        </ul>
        
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
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
                <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_{{$ci['id']}}">
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
                                    <a class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can" 
                                href = "{{ route('cart.remove', $ci['id'])}}"></a>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <div class="p-2 text-center cart-empty">
                            No Items
                        </div>
                    @endif
                </div>
            </li>
  
          <!--username dropdown-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"><i class="fas fa-wrench"></i><span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->name }}</span></a>
            <div class="dropdown-menu dropdown-primary dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('dash') }}">Dashboard</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  
      </div>
      <!-- Collapsible content -->
  
    </div>
  
  </nav>
  <!--/.Navbar-->
  @endif
@guest
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <!--<a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'iFruit') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                 Left Side Of Navbar
                @if(!Auth::guest())
                <ul class="navbar-nav mr-auto">
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
                        <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_{{$ci['id']}}">
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
                                            <a class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can" 
                                        href = "{{ route('cart.remove', $ci['id'])}}"></a>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <div class="p-2 text-center cart-empty">
                                    No Items
                                </div>
                            @endif
                        </div>
                    </li>

                </ul>
                @endif
            -->
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <!--<li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('dash') }}">
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>-->
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
        
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('sw/sweetalert2.js') }}"></script>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    @if(session()->has('status'))
    swal.fire("{{ session('msg') }}","{{ session('msg2') }}","{{ session('type') }}");
    @endif
    $(document).on('click', '.cart_delete_btn', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
        let qty = parseInt($("#cart_item_qty").text()); --qty;
        $("#cart_item_qty").text(qty);
        $.ajax({
            url: $(this).attr('href'),
        });
    });
</script>

@stack("js")
<script>

</script>
</body>
</html>
