<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- sucess UI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- import jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'
        integrity='sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=='
        crossorigin='anonymous'></script>

    <title> 帳號資料 </title>

    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
        integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
        crossorigin='anonymous' />

    @vite('resources/css/app.css')
    @vite('resources/css/layout.css')
    @vite('resources/css/components/Nav.css')
    @vite('resources/css/components/SideMenu.css')
    @vite('resources/css/components/Breadcrumb.css')

</head>

<body>

    <!-- Nav start ----- -->
    @include('layouts.adminAccountapp')
    <!-- Nav ends ------ -->
    <!-- Container start ----- -->
    <section class="container p-6 mx-auto">
        <!-- Card start ----- -->
        <form class="bg-white rounded-lg shadow-lg px-8 py-12 mt-20 flex flex-col gap-8 items-center max-w-2xl mx-auto">

            <h3 class="h3"> 個人帳號資料 </h3>

            <div class="flex gap-6 items-center">
                <div class="relative">
                    <img class="rounded-full w-60 shadow-md" src="{{ asset('media/Avatar.png') }}" alt="">
                    <button class="button small-btn secondary-btn absolute bottom-4 left-1/2 -translate-x-[50%]">
                        更換
                    </button>
                </div>

                <ul class="flex flex-col gap-2">
                    <li>
                        <span class="font-bold">帳號：</span>
                        <span>{{ Auth::guard('admin')->user()->account }} </span>
                    </li>
                    <li>
                        <span class="font-bold">角色：</span>
                        <span> {{ Auth::guard('admin')->user()->getRoleCName() }}</span>
                    </li>
                    <li>
                        <span class="font-bold">名稱：</span>
                        <span>{{ Auth::guard('admin')->user()->name }} </span>
                    </li>
                    <li>
                        <span class="font-bold">電郵地址:</span>
                        <span>{{ Auth::guard('admin')->user()->email}}</span>
                    </li>
                </ul>

            </div>
            <div class="flex gap-4 mt-4">
                <a class="button danger-outlined-btn" href="{{ route('account.renewpassword') }}">
                    重設密碼
                </a>
                <a class="button danger-outlined-btn" href="{{ route('account.newemail') }}">
                    重設電子郵件
                </a>
                <a class="button secondary-btn" href="{{ route('account.loginhistory') }}">
                    登入紀錄
                </a>
                <a class="button secondary-btn" href="{{ route('admin.logout') }}">登出</a>
            </div>
        </form>
        <!-- Card ends ------ -->
    </section>
    <!-- Container ends ------ -->

    @include('Sucess')
</body>

</html>
