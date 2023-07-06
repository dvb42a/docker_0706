<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> 管理員帳號個人頁面 </title>

        <!-- sucess UI -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <!-- import font awesome -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
            integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
            crossorigin='anonymous' />

        <!-- import jQuery -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'
            integrity='sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=='
            crossorigin='anonymous'></script>

        <!-- import CSS -->
        @vite('resources/css/app.css')
        @vite('resources/css/layout.css')
        @vite('resources/css/components/Nav.css')
        @vite('resources/css/components/SideMenu.css')
        @vite('resources/css/components/Breadcrumb.css')

    </head>

    <body>
        <!-- Nav start ----- -->
        <nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
            <div class="navbar-start">
                <a class="navbar-item title is-3" href="{{route('admin.main')}}">
                    <i class="fa-solid fa-user"></i>
                    <span class="site-title"> Kings管理員帳號個人頁面 </span>
                </a>
            </div>

        @include('layouts.platformselect')
        </nav>
        <!-- Nav ends ------ -->

        <!-- Side Menu start -  ---- -->
        <aside class="menu">
            <!-- menu-list start ----- -->
            <ul class="menu-list">
                <!-- dashboard -->
                <li><a class="menu-title {{ Request::routeIs('admin.main') ? 'is-active' : '' }} {{ Request::routeIs('account.loginhistory') ? 'is-active' : '' }}" href="{{route('admin.main')}}">帳號總覽</a>
                </li>
                <!-- web-setting -->
            </ul>
            <!-- menu-list ends ------ -->

            <!-- account-info start ----- -->
            @include('layouts.userinfo')
        </aside>
        <!-- Side Menu ends ------ -->


        {{-- import sideMenu js --}}
        <script src="{{ asset('javascript/sideMenu.js') }}"></script>
        <script src="{{ asset('javascript/locations/side-menu-display.js') }}" ></script>

        {{-- platform select --}}
        <script src="{{ asset('javascript/locations/platformselect.js') }}" ></script>

        {{-- locate page --}}
        <script>
            const locationName="{{ Route::currentRouteName() }}";
            locationActive(locationName);
            console.log(locationName);
        </script>

    </head>
    <body>
        @yield('content')
    </body>
</html>
