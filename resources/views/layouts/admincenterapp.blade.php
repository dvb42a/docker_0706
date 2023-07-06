<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 後臺管理介面 </title>

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
    @vite('resources/css/pages/table.css')


</head>

<body>
    <!-- Nav start ----- -->
    <nav class="nav z-20" role="navigation" aria-label="main navigation">
        <div>
            <a class="nav-title" href="{{ route('admin.center.main') }}" id="location">
                <i class="fa-solid fa-users-line"></i>
                <span class="site-title"> Kings全域後臺管理介面 v0.1 beta </span>
            </a>
        </div>

        @include('layouts.platformselect')
    </nav>
    <!-- Nav ends ------ -->

    <section class="w-full">

        <!-- Side Menu start ----- -->
        <aside class="menu">
            <!-- menu-list start ----- -->
            <ul class="menu-list">
                <!-- dashboard -->
                <li>
                    <a class="menu-title {{ Request::routeIs('admin.center.main') ? 'is-active' : '' }}"
                        href="{{ route('admin.center.main') }}" id="dashboard">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                </li>

                <!-- 管理員帳號管理 -->
                <li>
                    <a class="menu-title" href="#" id="adminAccountManage">
                        <i class="fa-solid fa-users"></i>
                        管理員帳號管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>

                    <ul class="sub-menu hidden" id="adminAccountMenu">
                        <li>
                            <a href="{{ route('admins.index') }}" class="menu-item {{ Request::routeIs('admins.index') ? 'is-active' : '' }}"" id="adminccountActive">管理員帳號列表</a>
                        </li>
                        <li>
                            <a href="{{route('roles.index')}}" class="menu-item">身分權限管理</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">凍結帳號管理</a>
                        </li>
                    </ul>
                </li>


            </ul>
            <!-- menu-list ends ------ -->

            <!-- account-info start ----- -->
            @include('layouts.userInfo')
        </aside>
        <!-- Side Menu ends ------ -->

        <!-- Breadcrumb start ----- -->
        <div class="ml-[240px]">
            @include('breadcrumbs')
        </div>
        <!-- Breadcrumb ends ------ -->

        {{-- 放置頁面內容 --}}
        <section class="relative ml-[240px] top-[68px]">

            @yield('content')

        </section>

    </section>

    <script src="{{ asset('javascript/centerAsideMenu.js') }}"></script>

    {{-- import switch platformselect --}}
    <script src="{{ asset('javascript/locations/link-url.js') }}"></script>
    <script src="{{ asset('javascript/locations/platformselect.js') }}"></script>

    <script>
        const locationName = "{{ Route::currentRouteName() }}";
        locationActive(locationName);
        console.log(locationName);
    </script>

    </head>

</html>
