<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Shop')</title>
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css')}}" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<div id="wrapper">
{{--    <div class="cart-icon-top">--}}
{{--    </div>--}}

{{--    <div class="cart-icon-bottom">--}}
{{--    </div>--}}

{{--    <div id="checkout">--}}
{{--        CHECKOUT--}}
{{--    </div>--}}

    <div id="info">
        <p class="i1">Add to cart interaction prototype by Virgil Pana</p>
        <p>    Follow me on <a href="https://dribbble.com/virgilpana" style="color:#ea4c89" target="_blank">Dribbble</a> | <a style="color:#2aa9e0" href="https://twitter.com/virgil_pana" target="_blank">Twitter</a></p>
    </div>

    <div id="header">
        <ul>
            <li><a href="{{route('client.home')}}">Home</a></li>
            <li><a href="">BRANDS</a></li>
            <li><a href="">DESIGNERS</a></li>
            <li><a href="">CONTACT</a></li>
        </ul>
        <div id="header-color">
            <ul>
                @if(Auth::check())
                    <p>Welcome, {{ Auth::user()->name }}</p>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                    <li><a href="{{ route('register') }}">REGISTER</a></li>
                @endif
            </ul>
        </div>
    </div>

    @include('client.layouts.sidebar')

    @yield('content')
</div>

{{--    @include('client.layouts.footer')--}}

<!-- partial -->
<script  src="{{asset('client/js/script.js')}}"></script>

</body>
</html>
