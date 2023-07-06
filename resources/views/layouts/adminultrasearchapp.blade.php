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

</head>

<body>
    <!-- Nav start ----- -->
    <navclass="nav z-20" role="navigation" aria-label="main navigation">
        <div>
            <a class="navbar-title" href="{{ route('admin.beauty.main') }}">
                <i class="fa-solid fa-swatchbook"></i>
                <span class="site-title"> 後臺管理介面 </span>
            </a>
        </div>

        @include('layouts.platformselect')
        </nav>
        <!-- Nav ends ------ -->

        <!-- Side Menu start ----- -->
        <aside class="menu">
            <!-- menu-list start ----- -->
            <ul class="menu-list">
                <!-- dashboard -->
                <li>
                    <a class="menu-title {{ Request::routeIs('search.index') ? 'is-active' : '' }}"
                        href="{{ route('search.index') }}">
                        資料庫搜尋
                    </a>
                </li>


            </ul>
            <!-- menu-list ends ------ -->

            <!-- account-info start ----- -->
            <div class="w-full flex p-4">
                <a href="#"
                    class="flex items-center gap-x-4 py-2 leading-6 text-slate-300 hover:opacity-90 hover:text-white">
                    <img class="h-8 w-8 rounded-full bg-gray-50"
                        src="https://images.unsplash.com/photo-1597223557154-721c1cecc4b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                        alt="">
                </a>
                <div class="w-[120px]">
                    <div>
                        <p class="font-bold">{{ Auth::user()->k_name }}</p>
                        <p class="text-xs">後端工程師</p>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button
                        class="border border-slate-400 w-9 h-9 flex items-center justify-center rounded hover:bg-white hover:text-slate-600 ease-in-out duration-200"
                        type="submit">
                        <span>
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Side Menu ends ------ -->
        <script src="{{ asset('javascript/sideMenu.js') }}"></script>
        <script src="{{ asset('javascript/locations/side-menu-display.js') }}"></script>
        <script src="{{ asset('javascript/locations/platformselect.js') }}"></script>
        <script>
            const locationName = "{{ Route::currentRouteName() }}";
            locationActive(locationName);
        </script>

        </head>

        <body>
            @yield('content')
        </body>

</html>
