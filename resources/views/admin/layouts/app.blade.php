
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title','Dashboard')</title>
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/js/adminlte.js')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{asset('https://kit.fontawesome.com/b99e675b6e.js')}}"></script>
    <!-- jQuery -->
    <script src="{{asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
{{--    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/ionicons/7.1.2/esm/ionicons.min.js')}}"></script>--}}
    <!-- SideBar-Menu CSS -->
    <script src="{{asset('admin/js/base.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $(".hamburger .hamburger__inner").click(function(){
                $(".wrapper").toggleClass("active")
            })

            $(".top_navbar .fas").click(function(){
                $(".profile_dd").toggleClass("active");
            });
        })
    </script>
</head>
<body>

<div class="wrapper">
    <div class="top_navbar">
        <div class="hamburger">
            <div class="hamburger__inner">
                <div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
            </div>
        </div>
        <div class="menu">
            <div class="logo">
                Dashboard
            </div>
            <div class="right_menu">
                <ul>
                    <li><i class="fas fa-user"></i>
                        <div class="profile_dd">
                            <div class="dd_item">Profile</div>
                            <div class="dd_item">Change Password</div>
                            <div class="dd_item"><form id="logoutForm" action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn">Log Out</button>
                                </form></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main_container">
        @include('admin.layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

</div>
@include('admin.layouts.footer')

</body>
</html>
