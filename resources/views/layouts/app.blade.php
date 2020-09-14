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

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'iFruit') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if(!Auth::guest())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cart (<span id="cart_item_qty">{{session()->has('cart') ? count(session('cart')) : 0}}</span>)
                        </a>
                        <div id="cart-list" style="width: 350px" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(session()->has('cart'))
                                @foreach(session('cart') as $ci)
                        <div class="row px-2 d-flex align-items-center justify-content-between" id = "data_{{$ci['id']}}">
                                        <div class="col-md-3">
                                            <img class="img-fluid" src="{{$ci['photo']}}" alt="">
                                        </div>
                                        <div class="col-md-7">
                                            <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                                <b>{{$ci['name']}}</b> <br>
                                            <span id="item_qty_{{$ci['id']}}">{{$ci['qty']}}</span>x{{$ci['item_price']}}EGP
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-sm btn-danger mdi mdi-trash-can" 
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
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
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
                        </li>
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
</script>
@stack("js")
</body>
</html>
